<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Service;

class Services extends Component
{
    public $searchText;
    public $countryId;
    public function render()
    {
        return view('livewire.user.service',[
            'services' => Service::search($this->searchText)->whereHas('countries', function ($query) {
                return $query->where('id', '=', $this->countryId);
            })->whereHas('providers')->orderBy('name','asc')->paginate(10),
        ]);
    }

    public function goToOrder($id)
    {
        return redirect()->to("country/$this->countryId/service/$id");
    }
}
