<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

abstract class SmsAPIBase
{
    abstract protected function getBalance();
    abstract protected function getServices();
    abstract protected function getStatus($orderId);
    abstract protected function orderNumber($countryRef, $serviceRef);
    abstract protected function getCountries();
    abstract protected function getPrices($countryRef, $serviceRef);

    function __construct()
    {
        $this->http = new Http;
    }

    protected Http $http;
}
