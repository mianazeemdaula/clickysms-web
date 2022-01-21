<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteProviderService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_provider_service', function (Blueprint $table) {
            $table->bigInteger('country_id');
            $table->bigInteger('service_id');
            $table->bigInteger('provider_id');
            $table->string('country_ref');
            $table->string('service_ref');
            $table->float('price')->default(0);
            $table->integer('stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_provider_service');
    }
}
