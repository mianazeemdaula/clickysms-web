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
            ['name' => 'sms-active.org', 'client_name' => 'Service 1', 'api_key' => '0168378949eb9d466A32A543864f0dc4', 'currency' => 'RUB', 'api_path' => 'App\Api\SMSActivateOrg'],
            ['name' => 'sms.red', 'client_name' => 'Service 2', 'api_key' => '226796f4ad0bb899201e28252f3cf809ace338e3', 'currency' => 'USD', 'api_path' => 'App\Api\SMSRed'],
            ['name' => 'sms-service-online.com', 'client_name' => 'Service 3', 'api_key' => '9670cfe6b9852d770768f41ead60197c', 'currency' => 'USD', 'api_path' => 'App\Api\SmsServiceOnlineCom'],
        ]);
    }
}
