<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Provider;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrderNumber extends Component
{
    use LivewireAlert;
    public $searchText;
    public $countryId;
    public $serviceId;

    public function render()
    {
        return view('livewire.user.order-number',[
            'providers' => Provider::whereHas('services', function ($q) {
                $q->where('id', '=', $this->serviceId);
            })->orderBy('name','asc')->paginate(10),
        ]);
    }

    public function placeOrder($id)
    {
        $this->alert('warning', 'Low Balance, Please topup.',[
            'position' => 'top'
        ]);
    }

}
