<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class,'country_provider_service')->withPivot('country_ref', 'service_ref');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class,'country_provider_service')->withPivot('country_ref', 'service_ref');
    }
}
