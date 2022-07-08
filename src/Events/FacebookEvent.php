<?php

namespace App\Events;

use Cake\Event\EventListenerInterface;
use Cake\Http\Client;
use Cake\Log\Log;

class FacebookEvent implements EventListenerInterface
{
    private $accessToken = "EAAKHMQxVp7oBAOBZBJWfaIxRS2WFpAYT3dnSZAATPqQirpF6FgZATZCZATtpjmixixqZAjb3UX59EH5a2wwDiFthALeoxUo7uLR7KDn4jhGWiLvtiB8Da8J6GA3h4ieFEwzOJtGqk2lK54cFKQmgxsJvuD0sPfpjSbtZAS82laku3ZBLZBmM0Smza";
    private $endPoint = "https://graph.facebook.com/v13.0/1954780331515974/events";

    public function implementedEvents()
    {
        return [
            'Facebook.Conversion.addToCart' => 'addToCart',
            'Facebook.Conversion.AddToWishList' => 'addToWishlist',
			'Facebook.Conversion.facebookPurchase' => 'facebookPurchase',
        ];
    }



    public function addToWishlist($event)
    {
        $request = $event->getData("request");
        $product = $event->getData("product");

        $http = new Client();
        $data = $this->getData($request, "Add to wishlist");
        $data['data'][0]['event_id'] = "product." . $product->design_no . "." . $product->id;

        $response = $http->post($this->endPoint, $data, [
            'headers' => [
                'Authorization' => "Bearer " . $this->accessToken
            ]
        ]);

        if (!$response->isOk()) {
            Log::error($response->getBody());
        }

        //Log::debug($request->getCookie("_fbp"));
    }

    public function addToCart($event)
    {
        $request = $event->getData("request");
        $product = $event->getData("product");

        $http = new Client();
        $data = $this->getData($request, "Add to cart");
        $data['data'][0]['event_id'] = "product." . $product->design_no . "." . $product->id;

        $response = $http->post($this->endPoint, $data, [
            'headers' => [
                'Authorization' => "Bearer " . $this->accessToken
            ]
        ]);

        if (!$response->isOk()) {
            Log::error($response->getBody());
        }

        //Log::debug($request->getCookie("_fbp"));
    }
	
	public function facebookPurchase($event)
    {
        $request = $event->getData("request");
        $product = $event->getData("product");
		$order = $event->getData("order");

        $http = new Client();
        $data = $this->getData($request, "Purchase");
		$custom_data = array(
			'currency' => $order->currency_code,
			'value' => $order->grand_total
		);
		$data['data'][0]['contents'] = $product;
		$data['data'][0]['custom_data'] = $custom_data;
		
		$response = $http->post($this->endPoint, $data, [
            'headers' => [
                'Authorization' => "Bearer " . $this->accessToken
            ]
        ]);
		if (!$response->isOk()) {
            Log::error($response->getBody());
        }
	}

    private function getData($request, $event)
    {
        return [
            "data" => [
                [
                    "event_name" => $event,
                    "event_time" => time(),
                    "action_source" => "website",
                    "event_source_url" => $request->referer(),
                    "event_id" => "",
                    "user_data" => [
                        "client_ip_address" => $request->clientIp(),
                        "client_user_agent" => $request->getHeaderLine("User-Agent"),
                        "fbp" => $request->getCookie("_fbp")
                    ]
                ]
            ]
        ];
    }
}
