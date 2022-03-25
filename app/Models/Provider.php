<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $cast = [
        'status' => 'boolean',
    ];

    protected $appends = ['api'];

    public function getApiAttribute($value)
    {
        return new $this->api_path($this->api_key);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'country_provider_service')
            ->withPivot('country_ref', 'service_ref', 'price', 'stock', 'reused');
    }

    public function services2()
    {
        return $this->hasMany(ServiceProvider::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_provider_service')
            ->withPivot('country_ref', 'service_ref', 'price', 'stock', 'reused');
    }

    public function apiCountries()
    {
        return $this->hasMany(ProviderCountry::class);
    }

    public function apiServices()
    {
        return $this->hasMany(ProviderService::class);
    }
}
