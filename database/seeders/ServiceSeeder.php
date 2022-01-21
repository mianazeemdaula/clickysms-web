<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Service;
use Illuminate\Support\Facades\Http;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = "https://sms.red/services_state";
        $response = Http::withHeaders([
            'X-API-KEY' => '226796f4ad0bb899201e28252f3cf809ace338e3',
        ])->asForm()->get($url);
        
        $data = [];
        foreach (collect($response->json()) as $service) {
            $data[] = [
                'name' => $service['name'],
            ];
        }
        Service::insert($data);
    }
}
