<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::insert([
            ['name' => 'sms-active.org', 'client_name' => 'Service 1', 'api_key' => '8cbd0f4Ab1761f58bcc6f2df8bb3c1fA', 'currency'=> 'RUB'],
            ['name' => 'sms.red', 'client_name' => 'Service 2', 'api_key' => '226796f4ad0bb899201e28252f3cf809ace338e3', 'currency'=> 'USD'],
            ['name' => 'sms-service-online.com', 'client_name' => 'Service 3', 'api_key' => '9670cfe6b9852d770768f41ead60197c', 'currency'=> 'USD'],
        ]);
    }
}
