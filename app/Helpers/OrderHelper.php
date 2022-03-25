<?php

namespace App\Helpers;

use App\Api\SMSActivateOrg;
use App\Http\Livewire\User\Order\SmsActiveOrg;
use App\Models\Country;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Service;
use Carbon\Carbon;

class OrderHelper
{
    static public function create(Provider $provider, $countryRef, $serviceRef,  $serviceId, $countryId)
    {
        if (class_exists($provider->api_path)) {
            $api = $provider->api;
            $price = $provider->charges;
            $orderNum = '';
            $mobileNum = '';
            $seconds = 0;
            if ($provider->api_path == SmsActiveOrg::class) {
                $api->orderNumber($countryRef, $serviceRef);
            }

            $order = new Order();
            $order->order_id = $orderNum;
            $order->mobile = $mobileNum;
            $order->user_id = auth()->id();
            $order->country_id = $countryId;
            $order->service_id = $serviceId;
            $order->provider_id = $provider->id;
            $order->price = $price;
            $order->expire_time = Carbon::now()->addSeconds($seconds);
            $order->save();
        } else {
            return ['status' => false, 'data' => 'API not Exist'];
        }
    }
}
