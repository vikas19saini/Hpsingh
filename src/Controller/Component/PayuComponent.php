<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Payu component
 */
class PayuComponent extends Component {

    protected $_defaultConfig = [];
    private $key;
    private $salt;
    private $end_point;

    public function initialize(array $config) {
        parent::initialize($config);

        $this->key = env('PAYU_KEY');
        $this->salt = env('PAYU_SALT_KEY');

        if (env('PAYU_MODE') === 'production') {
            $this->end_point = 'https://secure.payu.in/_payment';
        } else {
            $this->end_point = 'https://test.payu.in/_payment';
        }
    }

    public function generateFormData($order) {

        // Return error is store currency is not in INR
        if (strtoupper($this->request->getSession()->read('Config.defaultCurrency')->code) !== 'INR') {
            return ['status' => 'error', 'message' => 'Please choose a different payment method.'];
        }

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20); // Generating random transaction id
        $hash_string = "{$this->key}|{$txnid}|{$order->grand_total}|Hpsingh checkout|{$order->bname}|{$order->email}|{$order->id}||||||||||{$this->salt}";

        $hash = strtolower(hash('sha512', $hash_string));

        return [
            'hash' => $hash,
            'txnid' => $txnid,
            'key' => $this->key,
            'amount' => (string)$order->grand_total,
            'firstname' => $order->bname,
            'email' => $order->email,
            'phone' => $order->phone,
            'productinfo' => 'Hpsingh checkout',
            'surl' => \Cake\Routing\Router::url(['_name' => 'payu_pyment_confirm', '?' => ['status' => 'success']], true),
            'furl' => \Cake\Routing\Router::url(['_name' => 'payu_pyment_confirm', '?' => ['status' => 'fail']], true),
            'curl' => \Cake\Routing\Router::url(['_name' => 'payu_pyment_confirm', '?' => ['status' => 'cancel']], true),
            'address1' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'zipcode' => '',
            'udf1' => $order->id,
            'action' => $this->end_point,
        ];
    }

    public function authorizePayment($posted) {
        $status = $posted["status"];
        $firstname = $posted["firstname"];
        $amount = $posted["amount"]; //Please use the amount value from database
        $txnid = $posted["txnid"];
        $posted_hash = $posted["hash"];
        $key = $posted["key"];
        $productinfo = $posted["productinfo"];
        $email = $posted["email"];
        $salt = $this->salt;
        $udf1 = $posted['udf1'];

        if (isset($posted['additionalCharges'])) {
            $additionalCharges = $posted["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }

        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            return false;
        }

        return true;
    }

}
