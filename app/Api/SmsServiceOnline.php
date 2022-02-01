<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

class SmsServiceOnline{

    private $url = 'https://sms-service-online.com/stubs/handler_api';
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getBalance()
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getBalance',
            'lang' => 'en',
        ]);
        return $response->body();
    }

    public function orderNumber($country, $service)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getNumber',
            'country' => $country,
            'service' => $service,
            'lang' => 'en',
        ]);
        return $response->body();
    }

    public function getNumbersStatus($country)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getNumbersStatus',
            'country' => $country,
            'lang' => 'en',
        ]);
        return $response->json();
    }

    public function getPrices($country)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getServicesAndCost',
            'country' => $country,
            'lang' => 'en',
        ]);
        return $response->json();
    }

    public function setStatus($status, $id)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'setStatus',
            'status' => $status,
            'id' => $id,
        ]);
        return $response->body();
    }

    public function getStatus($id)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getStatus',
            'id' => $id,
            'lang' => 'en',
        ]);
        return $response->body();
    }

}