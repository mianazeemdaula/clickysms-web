<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = "https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json";
        $response = Http::get($url);
        $data = [];
        foreach (collect($response->json()) as $country) {
            $data[] = [
                'iso_code' => $country['isoCode'],
                'name' => $country['name'],
                'dial_code' => $country['dialCode'],
                'flag' => $country['flag'],
            ];
        }
        Country::insert($data);
    }
}
