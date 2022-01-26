<?php

use Cake\Core\Configure;

return [
    'HybridAuth' => [
        'debug_mode' => Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log',
        'providers' => [
            'Google' => [
                'enabled' => true,
                'keys' => [
                    'id' => '320168265137-pot5ekhg07ejob9e70or1l71ab93o2o7.apps.googleusercontent.com',
                    'secret' => 'FAc1BGDNfx3ceFXML4UE8SO4'
                ]
            ],
            'Facebook' => [
                'enabled' => true,
                'keys' => [
                    'id' => '958520648416982',
                    'secret' => '396ee00faf0af42b8fc89eb791be1f81'
                ],
                'scope' => 'email, public_profile'
            ]
        ]
    ],
];
