<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentGateway::insert([
            ['name' => 'Jazz Cash', 'account' => '03001234567', 'ref' => 'jazzcash'],
            ['name' => 'Easy Pessa', 'account' => '03451234567', 'ref' => 'easypesa'],
            ['name' => 'UPay', 'account' => '03331234567', 'ref' => 'upay'],
            ['name' => 'BitCoin', 'account' => '0xsjdflasjddfa5sf65s6f5sdsdf', 'ref' => 'bitcoin'],
        ]);
    }
}
