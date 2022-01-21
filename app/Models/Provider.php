<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class,'country_provider_service')->withPivot('country_ref', 'service_ref');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class,'country_provider_service')->withPivot('country_ref', 'service_ref');
    }
}
