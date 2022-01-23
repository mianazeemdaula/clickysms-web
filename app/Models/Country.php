<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('iso_code', 'like', '%'.$search.'%')
                ->orWhere('dial_code', 'like', '%'.$search.'%');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'country_provider_service')
        ->withPivot('country_ref', 'service_ref','price', 'stock');
    }


    public function providers()
    {
        return $this->belongsToMany(Provider::class,'country_provider_service')
        ->withPivot('country_ref', 'service_ref','price', 'stock');
    }
}
