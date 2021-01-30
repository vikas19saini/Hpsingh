<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;
/**
 * Fedex component
 */
class FedexComponent extends Component
{

    private $contactName = "Raghav Sood";
    private $companyName = "HP Singh";
    private $StreetLines = 'HP Singh Agencies Private Limited 111, 82-83 Vaikunth Building, Nehru Place';
    private $City = 'New Delhi';
    private $StateCode = 'DL';
    private $PostalCode = "110019";
    private $CountryCode = 'IND';

    public $components = ['Auth'];

    public function getEstimatedRate($address = null, $products = [], $cartQuantity = null)
    {

        $body = [
            "async" => false,
            "shipper_accounts" => [
                [
                    "id" => env("POSTMEN_SHPPER_ID")
                ]
            ],
            "is_document" => false,
            "shipment" => [
                "ship_from" => [
                    "contact_name" => $this->contactName,
                    "company_name" => $this->companyName,
                    "street1" => $this->StreetLines,
                    "country" => $this->CountryCode,
                    "type" => "business",
                    "postal_code" => $this->PostalCode,
                    "city" => $this->City,
                    "phone" => "9711073447",
                    "street2" => null,
                    "tax_id" => null,
                    "street3" => null,
                    "state" => $this->StateCode,
                    "email" => "raghav@hpsingh.com",
                    "fax" => null
                ],
                "ship_to" => [
                    "contact_name" => $address->name,
                    "phone" => $address->contact,
                    "email" => $this->Auth->user('email'),
                    "street1" => $address->address,
                    "city" => $address->city,
                    "postal_code" => (string) $address->postcode,
                    "state" => $address->zone->code,
                    "country" => $address->country->iso_code_3,
                    "type" => $address->type === 'office' ? 'business' : 'residential',
                ],
                "parcels" => $this->formatItems($products, $cartQuantity),
            ]
        ];

        $client = new Client([
            'headers' => [
                'content-type' => 'application/json',
                'postmen-api-key' => env("POSTMEN_KEY"),
            ]
        ]);

        $response = $client->post("https://production-api.postmen.com/v3/rates", json_encode($body));
        $shippingRates = [];
        if ($response->isOk()) {
            $response = $response->json;

            if ($response['meta']['code'] !== 200) {
                return ['status' => 'error', 'message' => 'Delivery not available at this location.'];
            }

            if ($response['data']['status'] !== 'calculated') {
                return ['status' => 'error', 'message' => 'Delivery not available at this location.'];
            }

            $defaultCurrency = $this->request->getSession()->read('Config.defaultCurrency');

            foreach ($response['data']['rates'] as $rate) {
                if (isset($rate['total_charge']['amount']) && !empty($rate['total_charge']['amount'])) {
                    $deliveryAmountText = \Cake\I18n\Number::currency((int) $rate['total_charge']['amount'] * $defaultCurrency->value, $defaultCurrency->code);
                    $deliveryAmount = (int) ($rate['total_charge']['amount'] * $defaultCurrency->value);

                    $shippingRate = [
                        "ServiceType" => $rate['service_name'],
                        "DeliveryTimestamp" => \Cake\I18n\Time::parse($rate['delivery_date'])->nice(),
                        "DeliveryDayOfWeek" => "",
                        "DeliveryDate" => \Cake\I18n\Time::parse($rate['delivery_date'])->nice(),
                        "DeliveryChargesText" => $deliveryAmountText,
                        "DeliveryCharges" => $deliveryAmount,
                    ];

                    array_push($shippingRates, $shippingRate);
                }
            }

            usort($shippingRates, function ($a, $b) {
                return $a['DeliveryCharges'] - $b['DeliveryCharges'];
            });

            if (!empty($shippingRates)) {
                $shippingRates = $shippingRates[0];
            }
        }

        if (array_key_exists('DeliveryCharges', $shippingRates) && !empty($shippingRates['DeliveryCharges'])) {
            return $shippingRates + ['status' => 'success'];
        } else {
            return $shippingRates + ['status' => 'error', 'message' => 'Delivery not available at this location.'];
        }
    }

    private function formatItems($products, $cartQuantity)
    {

        $parcelItems = [];
        $parcelWeight = 0;

        foreach ($products as $product) {
            $pw = empty($product->shipping_weight) ? 0.25 : $product->shipping_weight;
            $parcelWeight += ceil($pw * $cartQuantity[$product->id]['qty']);

            $item = [
                "description" => $product->name,
                "origin_country" => "IND",
                "quantity" => (int) $cartQuantity[$product->id]['qty'],
                "price" => [
                    "amount" => !empty($product->sale_price) ? $product->sale_price : $product->ragular_price,
                    "currency" => "INR"
                ],
                "weight" => [
                    "value" => empty($product->shipping_weight) ? 0.25 : $product->shipping_weight,
                    "unit" => "kg"
                ],
                "sku" => $product->design_no,
            ];

            array_push($parcelItems, $item);
        }

        $parcelDetails = [
            [
                "description" => "Hpsingh Products",
                "box_type" => "custom",
                "weight" => [
                    "value" => $parcelWeight,
                    "unit" => "kg"
                ],
                "dimension" => [
                    "width" => 10,
                    "height" => 10,
                    "depth" => 10,
                    "unit" => "in"
                ],
                "items" => $parcelItems,
            ]
        ];

        return $parcelDetails;
    }
}
