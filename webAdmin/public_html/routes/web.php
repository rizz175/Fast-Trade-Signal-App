<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\ForexController;
use App\Http\Controllers\TmessageController;

use App\Http\Controllers\PageController;
use App\Http\Controllers\HistoricalForexController;
use App\Http\Controllers\HistoricalCryptoController;
use App\Http\Controllers\SettingController;
use App\Models\Forex;
use App\Models\Tmessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/admin/login', [PageController::class,'showAdminLogin'])->name('admin.login.page');
Route::post('admin/login/post',[AuthController::class,'adminLogin'])->name('admin.login');

Route::group(['middleware' => 'auth:admin'], function () {
   ////////////  dashboard route  /////////
   Route::view('/', 'dashboard')->name('dashboard');
   ////////////  user controller Route  /////////
   Route::post('/save-token', [UserController::class, 'saveToken'])->name('save-token');
   ////////////  user controller Route  /////////
   Route::resource('user',UserController::class); 
   ////////////  forex controller Route  /////////
   Route::resource('forex',ForexController::class);
   ///////////  Crypto Controller route  /////////
   Route::resource('crypto',CryptoController::class);
   
   Route::resource('tmessage',TmessageController::class);
    
   ///////// settings  /////////
    Route::resource('setting', SettingController::class);
    

   // historical forex/crypto routes

   ///////// get trashed data in historical forex signals  /////////
   Route::get('/historical/forex',[HistoricalForexController::class,'TrashedForexSignalsIndex'])->name('historicalForex');
   ///////// delete Historical Forex signal /////////
   Route::post('/delete/historical/forex/signal/{id}',[HistoricalForexController::class,'deleteForexSignal'])->name('deleteHistoricalForex');
   ///////// update historical signals  /////////
   Route::post('/update/historical/forex/signal/{id}',[HistoricalForexController::class,'updateHistoricalForexSignal'])->name('updatehistoricalforex');
   ///////// get trashed data in historical crypto signals  /////////
   Route::get('/historical/crypto',[HistoricalCryptoController::class,'TrashedCryptoSignalsIndex'])->name('historicalCrypto');
   ///////// delete Historical Crypto  signal /////////
   Route::post('/delete/historical/crypto/signal/{id}',[HistoricalCryptoController::class,'deleteCryptoSignal'])->name('deleteHistoricalCrypto');
   ///////// update historical signals  /////////
   Route::post('/update/historical/crypto/signal/{id}',[HistoricalCryptoController::class,'updateHistoricalCryptoSignal'])->name('updatehistoricalcrypto');

   Route::get('admin/logout',[AuthController::class,'logout'])->name('admin.logout');

});

// Clear Cache
Route::get('clear', function(){
    $clearcache = \Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    // $clearview = \Artisan::call('view:clear');
    // echo "View cleared<br>";

    // $clearconfig = \Artisan::call('config:cache');
    // echo "Config cleared<br>";

    $clearconfig = \Artisan::call('route:clear');
    echo "Route cleared<br>";
});

