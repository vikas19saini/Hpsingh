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
                    'id' => '1527959277351847',
                    'secret' => '843bbe47725a447a5a5485515c9be779'
                ],
                'scope' => 'email, public_profile'
            ]
        ]
    ],
];
