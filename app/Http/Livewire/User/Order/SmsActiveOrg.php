<?php

namespace App\Http\Livewire\User\Order;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;
use App\Api\SMSActivateOrg;

// READY -> WAITING -> RECEIVED | RESEND | CANCELED | ERROR

class SmsActiveOrg extends Component
{
    public Order $order;
    public $status;
    public $response2;
    public function mount()
    {
        $this->status = $this->order->status;
    }
    
    public function render()
    {
        return view('livewire.user.order.sms-active-org');
    }

    public function checkSms()
    {
        if($this->order->status == 'WAITING'){
            $api = new SMSActivateOrg($this->order->provider->api_key);
            $res = $api->getStatus($this->order->order_id);
            $this->response2 = $res;
            if($res == 'STATUS_OK'){
                $this->order->update(['status' => 'RECEIVED', 'response' => $res]);
                $this->emit('stopInterval');
            }else if( $res == 'STATUS_CANCEL'){
                $this->order->update(['status' => 'CANCELED', 'response' => $res]);
                auth()->user()->increment('balance', $this->order->price);
                $this->emit('stopInterval');
            }
            
        }
    }

    public function setStatus($status)
    {
        $api = new SMSActivateOrg($this->order->provider->api_key);
        $res = $api->setStatus($status,$this->order->order_id);
        if($res == 'ACCESS_READY'){
            $this->order->update(['status' => 'WAITING']);
        }
    }

    public function updatedOrder($value)
    {
        $this->status = $value->status;
    }
}
