<?php

use App\Api\SMSActivateOrg;
use App\Api\SMSRed;
use App\Http\Livewire\Admin\ProviderView;
use App\Http\Livewire\User\Order\SmsActiveOrg;
use App\Models\Provider;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', App\Http\Livewire\Guest\Index::class);

Route::get('smsactive', [App\Http\Controllers\SMSTestController::class, 'smsactive']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/provider', ProviderView::class)->name('provider');

    Route::get('country/{countryId}', function ($id) {
        return view('user.service', compact('id'));
    });

    Route::get('country/{countryId}/service/{serviceId}', function ($cId, $sId) {
        return view('user.order_number', compact('cId', 'sId'));
    });

    Route::get('order/{id}', function ($id) {
        $order = \App\Models\Order::findOrFail($id);
        return view('user.order', compact('order'));
    });
});


Route::get('test', function () {

    // return Provider::find(1)->api->orderNumber(187, 'go');
    return Provider::find(1)->api->getPrices(187);
    // $url = "https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json";
    // $url = "https://api.sms-activate.org/stubs/handler_api.php?api_key=8cbd0f4Ab1761f58bcc6f2df8bb3c1fA&action=getCountries";
    // $url = "https://sms.red/services_state";
    // $response = Http::withHeaders([
    //     'X-API-KEY' => '226796f4ad0bb899201e28252f3cf809ace338e3',
    // ])->asForm()->get($url);
    // return $response->body();
    $api = new SMSActivateOrg('0168378949eb9d466A32A543864f0dc4');
    $data =  collect($api->getPrices(187));
    return $data;

    $api = new \App\Api\SMSActivateOrg(\App\Models\Provider::find(1)->api_key);
    return $api->getPrices(187);

    // $d = \App\Models\Provider::find(3)->services()->wherePivot('service_ref','wa')->first();
    // if($d){
    //     return $d->pivot->update(['price' => 0.5]);
    // }
    // return 'no conete';

    $data =  \App\Models\Provider::whereHas('services', function ($q) {
        $q->where('id', 3);
    })->get();

    $data = \App\Models\Country::find(234);

    return  response()->json([$data->deployments, $data->services2], 200, [], JSON_PRETTY_PRINT);
});


Route::get('sms.red', function () {
    $api = new \App\Api\SMSRed("226796f4ad0bb899201e28252f3cf809ace338e3");
    return $api->getBalance();
});
