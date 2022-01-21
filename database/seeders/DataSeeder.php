<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Country;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::find(234);
        $country->services()->attach(1, ['provider_id' => 1, 'country_ref' => 185,'service_ref' => 'go']);
        $country->services()->attach(2, ['provider_id' => 1, 'country_ref' => 185,'service_ref' => 'ap']);
        $country->services()->attach(3, ['provider_id' => 1, 'country_ref' => 185,'service_ref' => 'js']);
    }
}
