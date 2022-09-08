<?php

use App\Http\Controllers\Api\CryptoController;
use App\Http\Controllers\Api\ForexController;
use App\Http\Controllers\TmessageController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Crypto;
use App\Models\Forex;
use App\Models\Tmessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('check-user', [AuthController::class, 'checkUser'])->middleware('auth:api');
Route::get('setting', [AuthController::class, 'setting']);
////////// Auth user login ///////// 
Route::post('login', [AuthController::class, 'login']);
////////// Auth user logout /////////
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:api');
////////// CRUD API's For Forex Signals //////////



//////////  historical forex signals get //////////
Route::get('get/all/historical/forex',[ForexController::class,'getHistoricalForex']);
//////////  historical Crypto signals get //////////
Route::get('get/all/historical/crypto',[CryptoController::class,'getHistoricalCrypto']);
    
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('create/forex', [ForexController::class,'createForexSignal']);

    Route::get('get/forex', [ForexController::class,'getAllForexSignal']);

 
    Route::get('get/forex/signal/{id}', [ForexController::class,'getForexSignal']);

    
    /////////// CRUD Api's For Forex Signals //////////
    Route::post('create/crypto',[CryptoController::class,'createCryptoSignal']);

    Route::get('get/all/crypto/signals', [CryptoController::class,'getAllCryptoSignal']);
    

    Route::get('get/crypto/signal/{id}', [CryptoController::class,'getCryptoSignal']);
    

    Route::group(['middleware' => 'admin'], function() {

        // delete only admin
        Route::delete('delete/crypto/signal/{id}', [CryptoController::class,'deleteCryptoSignal']);

        // delete only admin
        Route::put('update/crypto/signal/{id}', [CryptoController::class,'updateCryptoSignal']);
        // delete only admin
        Route::delete('delete/forex/signal/{id}',[ForexController::class,'deleteForexSignal']);

        // delete only admin
        Route::put('update/forex/signal/{id}',[ForexController::class,'updateForexSignal']);
    });

});