<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Country;

class Index extends Component
{
    public $searchText;

    public function render()
    {
        return view('livewire.user.index', [
            'countries' => Country::search($this->searchText)->whereHas('services')->orderBy('name', 'asc')->paginate(10),
        ]);
    }

    public function goToService($id)
    {
        return redirect()->to("country/$id");
    }
}
