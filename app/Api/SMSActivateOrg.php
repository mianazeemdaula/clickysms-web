<?php

namespace App\Api;

use App\Helpers\ApiResponses;
use App\Helpers\SmsAPIBase;
use Exception;

class SMSActivateOrg extends SmsAPIBase
{
    private $url = 'https://api.sms-activate.org/stubs/handler_api.php';
    private $apiKey;

    public function __construct($apiKey)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
    }

    public function getBalance()
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getBalance',
        ]);
        $res = explode(":", $response->body());
        if ($res[0] === 'ACCESS_BALANCE') {
            return ApiResponses::balance($res[1]);
        }
        throw ApiResponses::error($res[0]);
    }

    public function orderNumber($country, $service)
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getNumber',
            'country' => $country,
            'service' => $service,
        ]);
        $res = explode(":", $response->body());
        if ($res[0] === 'ACCESS_NUMBER') {
            return ApiResponses::order($res[1], $res[2], 20 / 60);
        }
        throw ApiResponses::error($res[0]);
    }

    public function getNumbersStatus($country)
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getNumbersStatus',
            'country' => $country,
        ]);
        return $response->json();
    }

    public function getPrices($country, $serviceId = 0)
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getPrices',
            'country' => $country,
        ]);
        return $response->json();
    }

    public function setStatus($status, $id)
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'setStatus',
            'status' => $status,
            'id' => $id,
        ]);
        return $response->body();
    }

    public function getStatus($id)
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getStatus',
            'id' => $id,
        ]);
        return $response->body();
    }

    public function getServices()
    {
    }

    public function getCountries()
    {
        $response = $this->http::get($this->url, [
            'api_key' => $this->apiKey,
            'action' => 'getCountries',
        ]);
        return $response->body();
    }
}
