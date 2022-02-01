<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

class SMSRed{

    private $url = 'https://sms.red';
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getBalance()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->get($this->url."/my_balance");
        return $response->json();
    }

    public function orderNumber($service)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->post($this->url."/order_number",[
            'service_id' => $service,
        ]);
        return $response->json();
    }

    public function getServices()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->get($this->url."/services_state");
        return $response->json();
    }

    public function getQuantity()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->get($this->url."/available_quantity");
        return $response->json();
    }

    public function getStatus($number, $id)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->get($this->url."/check_sms",[
            'order_id' => $id,
            'number' => $number,
        ]);
        return $response->json();
    }

}