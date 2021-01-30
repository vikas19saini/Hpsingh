<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaypalComponent extends Component
{

    protected $_defaultConfig = [];
    private $api_uri;
    private $client_id;
    private $client_secret;
    private $headers = [
        'Content-Type: application/json',
        'Accept-Language: en_US',
    ];
    private $access_token;
    private $paypalClient;

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->client_id = env('PAYPAL_CLIENT_ID');
        $this->client_secret = env('PAYPAL_CLIENT_SECRET_ID');
        $environment = '';
        if (env('PAYPAL_MODE') === 'production') {
            $this->api_uri = 'https://api.paypal.com/';
            $environment = new ProductionEnvironment($this->client_id, $this->client_secret);
        } else {
            $this->api_uri = 'https://api.sandbox.paypal.com/';
            $environment = new SandboxEnvironment($this->client_id, $this->client_secret);
        }

        $this->paypalClient = new PayPalHttpClient($environment); //Setting up paypal environment

        $http = new Client();
        $response = $http->post($this->api_uri . 'v1/oauth2/token', ['grant_type' => 'client_credentials'], [
            'headers' => $this->headers,
            'auth' => ['username' => $this->client_id, 'password' => $this->client_secret],
        ]);

        if ($response->isOk()) {
            $this->access_token = $response->json['access_token'];
        }
    }

    public function createOrder($order)
    {

        if (!is_object($order)) {
            return false;
        }

        $request = new OrdersCreateRequest();

        $request->prefer('return=representation');
        $request->body = self::__buildRequestBody($order);
        $response = $this->paypalClient->execute($request);

        return $response;
    }

    private static function __buildRequestBody($order): array
    {
        ini_set('serialize_precision', 14);
        $request = [
            'intent' => 'CAPTURE',
            'application_context' => [
                'brand_name' => \Cake\Core\Configure::read('Store.name'),
                'shipping_preferences' => 'NO_SHIPPING',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $order->currency_code,
                        'value' => $order->grand_total,
                    ],
                    'custom_id' => $order->id,
                ]
            ],
        ];
        return $request;
    }

    // Capture payment and get details
    public function capturePayment($order_id)
    {

        if (empty($order_id)) {
            return false;
        }

        $request = new OrdersCaptureRequest($order_id);
        $response = $this->paypalClient->execute($request);
        return $response;
    }

    // Get order to validate payment
    public function getOrderDetails($order_id)
    {
        if (empty($order_id)) {
            return false;
        }

        $request = new OrdersGetRequest($order_id);
        $response = $this->paypalClient->execute($request);
        return $response;
    }

}
