<?php

namespace App\Http\Livewire\User\Order;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;
use App\Api\SMSReds;

class SmsRed extends Component
{
    public Order $order;
    public $status;

    public function render()
    {
        return view('livewire.user.order.sms-red');
    }

    public function checkSms()
    {
        if($this->order->status == 'WAITING'){
            $api = new SMSActivateOrg($this->order->provider->api_key);
            $res = $api->getStatus($this->order->order_id);
            $this->response2 = $res;
            if($res['state'] == 'SMS_RECEIVED'){
                $this->order->update(['status' => 'RECEIVED', 'response' => $res, 'code' => $res['code'], 'sms' => $res['sms_content']]);
                $this->emit('stopInterval');
            }else if( $res['state'] != 'WAITING_FOR_SMS'){
                $this->order->update(['status' => 'CANCELED', 'response' => $res]);
                auth()->user()->increment('balance', $this->order->price);
                $this->emit('stopInterval');
            }
            
        }
    }

    public function updatedOrder($value)
    {
        $this->status = $value->status;
    }
}
