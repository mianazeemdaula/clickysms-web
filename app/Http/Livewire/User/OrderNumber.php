<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Provider;
use App\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Api\SMSActivateOrg;
use App\Models\Order;
class OrderNumber extends Component
{
    use LivewireAlert;
    public $searchText;
    public $countryId;
    public $serviceId;

    public function render()
    {
        return view('livewire.user.order-number',[
            'providers' => Service::find($this->serviceId)->providers()->wherePivot('country_id', $this->countryId)->paginate(10),
        ]);
    }

    public function placeOrder($data)
    {
        $provider = Provider::find($data['provider_id']);
        if($provider->name == 'sms-active.org'){
            $api = new SMSActivateOrg($provider->api_key);
            $response = $api->orderNumber((int) $data['country_ref'], $data['service_ref']);
            $_d = explode(':',$response);
            if($_d[0] == 'ACCESS_NUMBER'){
                $charges =  $data['price'] + $provider->charges;
                $order = new Order();
                $order->order_id = $_d[1];
                $order->mobile = $_d[2];
                $order->user_id = auth()->id();
                $order->country_id = $this->countryId;
                $order->service_id = $this->serviceId;
                $order->provider_id = $data['provider_id'];
                $order->price = $charges;
                $order->expire_time = Carbon::now()->addMinutes(20);
                $order->save();
                $res = $api->setStatus(1,$_d[1]);
                auth()->user()->decrement('balance', $charges);
                return redirect()->to("/order/$order->id");
            }else{
                $this->alert('warning', $response,[
                    'position' => 'top'
                ]);
            }
        }else if($provider->name == 'sms.red'){
            $api = new \App\Api\SMSRed($provider->api_key);
            $response = $api->orderNumber($data['service_ref']);
            if($response['status']){
                $charges =  $data['price'];
                $order = new Order();
                $order->order_id = $response['order_id'];
                $order->mobile = $response['number'];
                $order->user_id = auth()->id();
                $order->country_id = $this->countryId;
                $order->service_id = $this->serviceId;
                $order->provider_id =$provider->id;
                $order->price = $charges;
                $order->expire_time = Carbon::now()->addSeconds($response['remaining_seconds']);
                $order->save();
                auth()->user()->decrement('balance', $charges);
                return redirect()->to("/order/$order->id");
            }else{
                $this->alert('warning', $response['msg'],[
                    'position' => 'top'
                ]);
            }
        }
        
    }

}
