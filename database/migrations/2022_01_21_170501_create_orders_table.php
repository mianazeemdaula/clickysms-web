<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('mobile',15);
            $table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->bigInteger('service_id');
            $table->bigInteger('provider_id');
            $table->float('price')->default(0.25);
            $table->string('sms')->nullable();
            $table->text('response')->nullable();
            $table->char('code',20)->nullable();
            $table->char('status',20)->default('READY');
            $table->dateTime('expire_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
