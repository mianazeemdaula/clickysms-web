<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('smsactive', [App\Http\Controllers\SMSTestController::class, 'smsactive']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('country/{countryId}', function ($id) {
        return view('user.service', compact('id'));
    });

    Route::get('country/{countryId}/service/{serviceId}', function ($cId, $sId) {
        return view('user.order_number', compact('cId', 'sId'));
    });
});


Route::get('test', function(){
    
    // $url = "https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json";
    // $url = "https://api.sms-activate.org/stubs/handler_api.php?api_key=8cbd0f4Ab1761f58bcc6f2df8bb3c1fA&action=getCountries";
    // $url = "https://sms.red/services_state";
    // $response = Http::withHeaders([
    //     'X-API-KEY' => '226796f4ad0bb899201e28252f3cf809ace338e3',
    // ])->asForm()->get($url);
    // return $response->body();

    $data =  \App\Models\Provider::whereHas('services', function($q){
        $q->where('id', 3);
    })->get();
    return $data;
});