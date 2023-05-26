<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;

class GeolocationComponent extends Component
{

    protected $_defaultConfig = [];
    private $ip_lookup_apis = [
        'https://ipinfo.io/%s/json',
        'http://ip-api.com/json/%s',
    ];

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setDefaultCurrency();
    }

    public function setDefaultCurrency()
    {

        $country = \Cake\ORM\TableRegistry::getTableLocator()->get('Currencies');

        if ($this->request->getParam('prefix') !== 'hpadmin') {

            $country_code = $this->__getVisitorCountryCode();
            /* $country_code = 'IN'; */
            $this->request->getSession()->write('Config.countryCode', $country_code);

            if (!$this->request->getSession()->check('Config.defaultCurrency')) {
                if (!$country_code) {
                    $defaultCurrency = $country->find('all', [
                        'conditions' => ['is_default' => 'yes']
                    ])->first();
                } else {
                    $defaultCurrency = $country->find('all', [
                        'conditions' => ['country_code' => $country_code]
                    ])->first();
                }

                if (!$defaultCurrency) {
                    $defaultCurrency = $country->find('all', [
                        'conditions' => ['country_code' => 'US'],
                    ])->first();
                }

                $this->request->getSession()->write('Config.defaultCurrency', $defaultCurrency);
            }
        }
    }

    private function __getVisitorCountryCode()
    {

        try {
            $http = new Client();

            // first api call

            $response = $http->get(sprintf('https://ipinfo.io/%s/json', $this->request->clientIp()));

            if ($response->isOk()) {
                $response = $response->json;

                if (array_key_exists('country', $response)) {
                    return $response['country'];
                }
            }


            // second api call if first not working

            $response = $http->get(sprintf('http://ip-api.com/json/%s', $this->request->clientIp()));

            if ($response->isOk()) {
                $response = $response->json;

                if (array_key_exists('countryCode', $response)) {
                    return $response['countryCode'];
                }
            }

            return false;
        } catch (\RuntimeException $e) {
            return false;
        }
    }
}
