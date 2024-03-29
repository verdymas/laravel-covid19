<?php

// admin-controller
use App\Http\Controllers\Admin\HistoriController as AdmHistoriController;
use App\Http\Controllers\Admin\HomeController as AdmHomeController;
use App\Http\Controllers\Admin\KkController as AdmKkController;
use App\Http\Controllers\Admin\LoginController as AdmLoginController;
use App\Http\Controllers\Admin\SatgasController as AdmSatgasController;
use App\Http\Controllers\Admin\WargaController as AdmWargaController;
use App\Http\Controllers\Admin\BantuanController as AdmBantuanController;
use App\Http\Controllers\Admin\AccountController as AdmAccountController;

// satgas-controller
use App\Http\Controllers\Satgas\HomeController as StgHomeController;
use App\Http\Controllers\Satgas\KesehatanController as StgSehatController;
use App\Http\Controllers\Satgas\LoginController as StgLoginController;
use App\Http\Controllers\Satgas\HistoriController as StgHistoriController;
use App\Http\Controllers\Satgas\BantuanController as StgBantuanController;
use App\Http\Controllers\Satgas\AccountController as StgAccountController;
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

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// admin-route
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdmLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdmLoginController::class, 'login'])->name('admin.post_login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('home', [AdmHomeController::class, 'index'])->name('admin.home');
        Route::get('laporan', [AdmHomeController::class, 'laporan'])->name('admin.laporan');

        Route::prefix('data')->group(function () {
            //kartu-keluarga
            Route::resource('kartu-keluarga', AdmKkController::class);
            //warga
            Route::resource('warga', AdmWargaController::class);
            //satgas
            Route::resource('satgas', AdmSatgasController::class);
        });

        //bantuan
        Route::resource('bantuan', AdmBantuanController::class);

        //histori
        Route::resource('histori', AdmHistoriController::class);

        //account
        Route::resource('account', AdmAccountController::class);

        Route::get('logout', [AdmLoginController::class, 'logout'])->name('admin.logout');
    });
});

// satgas-route
Route::group(['prefix' => 'satgas'], function () {
    Route::get('login', [StgLoginController::class, 'showLoginForm'])->name('satgas.login');
    Route::post('login', [StgLoginController::class, 'login'])->name('satgas.post_login');

    Route::group(['middleware' => 'satgas'], function () {
        Route::get('home', [StgHomeController::class, 'index'])->name('satgas.home');
        Route::get('laporan', [StgHomeController::class, 'laporan'])->name('satgas.laporan');

        Route::resource('kesehatan', StgSehatController::class);
        Route::resource('bantuan', StgBantuanController::class, ['as' => 'stg']);
        Route::resource('histori', StgHistoriController::class, ['as' => 'stg']);
        Route::resource('account', StgAccountController::class, ['as' => 'stg']);

        Route::get('logout', [StgLoginController::class, 'logout'])->name('satgas.logout');
    });
});
