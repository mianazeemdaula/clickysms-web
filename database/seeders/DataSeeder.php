<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\ServiceProvider;
use App\Api\SMSActivateOrg;

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
        $country->services()->attach(1, ['provider_id' => 1, 'country_ref' => 187,'service_ref' => 'go', 'price' => 0.75, 'stock' => 5]);
        $country->services()->attach(2, ['provider_id' => 1, 'country_ref' => 187,'service_ref' => 'ot', 'price' => 0.75, 'stock' => 5]);
        $country->services()->attach(1001, ['provider_id' => 1, 'country_ref' => 187,'service_ref' => 'wa', 'price' => 0.75, 'stock' => 5]);
        $country->services()->attach(569, ['provider_id' => 1, 'country_ref' => 187,'service_ref' => 'mm', 'price' => 0.25, 'stock' => 5]);
        $country->services()->attach(956, ['provider_id' => 1, 'country_ref' => 187,'service_ref' => 'vk', 'price' => 0.25, 'stock' => 5]);
        Country::find(100)->services()->attach(569, ['provider_id' => 1, 'country_ref' => 6,'service_ref' => 'mm', 'price' => 0.12, 'stock' => 5]);
        // ServiceProvider::insert([
        //     ['country_id' => 234, 'service_id'=> 1,'provider_id' => 1, 'country_ref' => 185,'service_ref' => 'go', 'price' => 0.25, 'stock' => 5],
        //     ['country_id' => 234, 'service_id'=> 1001,'provider_id' => 1, 'country_ref' => 185,'service_ref' => 'wa', 'price' => 0.35, 'stock' => 5],
        //     ['country_id' => 234, 'service_id'=> 634,'provider_id' => 1, 'country_ref' => 185,'service_ref' => 'ok', 'price' => 0.50, 'stock' => 5],
        // ]);

        // https://free.currconv.com/api/v7/convert?q=USD_RUB&compact=ultra&apiKey=ef8ba76ba485f8b50d84

        $api = new SMSActivateOrg('8cbd0f4Ab1761f58bcc6f2df8bb3c1fA');
        $data =  collect($api->getPrices(187));
        $data = $data['187'];

        foreach ($data as $key => $value) {
            $d = $country->services()->wherePivot('provider_id', 1)->wherePivot('service_ref', $key)->first();
            if($d){
                $d->pivot->update(['price' => $value['cost'] / 77.590304, 'stock' => $value['count']]);
            }
        }

        $api = new \App\Api\SMSRed("226796f4ad0bb899201e28252f3cf809ace338e3");
        $services = $api->getServices();
        foreach ($services as $value) {
            $service = \App\Models\Service::where('name',$value['name'])->first();
            if($service){
                $country->services()->attach($service->id, ['provider_id' => 2, 'country_ref' => $country->id,'service_ref' => $value['id'], 'price' => $value['price_per_code'] + 0.10, 'stock' => 1]);
            }
        }
    }
}
