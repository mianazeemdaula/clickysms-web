<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

class SMSActivateOrg{

    private $url = 'https://api.sms-activate.org/stubs/handler_api.php';
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
        ]);
        return $response->body();
    }

    public function getNumbersStatus($country)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getNumbersStatus',
            'country' => $country,
        ]);
        return $response->json();
    }

    public function getPrices($country)
    {
        $response = Http::get($this->url,[
            'api_key' => $this->apiKey,
            'action' => 'getPrices',
            'country' => $country,
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
        ]);
        return $response->body();
    }

}