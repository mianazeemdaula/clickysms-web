<?php

namespace App\Http\Livewire\Admin;

use App\Models\Provider;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProviderView extends Component
{
    use LivewireAlert;
    public $isCreateModelOpen = false;
    public $isEditModelOpen = false;

    public Provider $provider;


    public function openCreate()
    {
        $this->isCreateModelOpen = true;
        $this->resetErrorBag();
        $this->provider = new Provider();
    }

    public function editProvider($id)
    {
        $this->isEditModelOpen = true;
        $this->provider =  Provider::find($id);
        $this->resetErrorBag();
    }


    public function createProvider()
    {
        $this->validate();
        $this->provider->save();
        $this->alert('success', 'Provider Created', [
            'position' => 'top'
        ]);
        $this->isCreateModelOpen = false;
    }

    public function updateProvider()
    {
        $this->validate();
        $this->provider->save();
        $this->alert('success', 'Provider updated', [
            'position' => 'top'
        ]);
        $this->isEditModelOpen = false;
    }

    public function render()
    {
        return view('livewire.admin.provider-view', [
            'providers' => Provider::paginate(10),
        ]);
    }

    public function statusUpdate($id)
    {
        $provider = Provider::find($id);
        $provider->active = !$provider->active;
        $provider->save();
    }

    public function getBalance($id)
    {
        $provider  =  Provider::find($id);
        dd($provider->api->getBalance());
    }

    protected $rules = [
        'provider.name' => 'required',
        'provider.client_name' => 'required',
        'provider.currency' => 'required',
        'provider.charges' => 'required',
        'provider.api_key' => 'required',
    ];
}
