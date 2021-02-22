<?php

use Illuminate\Support\Facades\Route;

// admin-controller
use App\Http\Controllers\Admin\LoginController as AdmLoginController;
use App\Http\Controllers\Admin\HomeController as AdmHomeController;
use App\Http\Controllers\Admin\KkController as AdmKkController;
use App\Http\Controllers\Admin\WargaController as AdmWargaController;
use App\Http\Controllers\Admin\SatgasController as AdmSatgasController;

// satgas-controller
use App\Http\Controllers\Satgas\LoginController as StgLoginController;
use App\Http\Controllers\Satgas\HomeController as StgHomeController;

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
Route::group(['prefix' => 'admin'], function() {
	Route::get('login', [AdmLoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('login', [AdmLoginController::class, 'login'])->name('admin.post_login');

	Route::group(['middleware' => 'admin'], function() {
		Route::get('home', [AdmHomeController::class, 'index'])->name('admin.home');

		//kartu-keluarga
		Route::resource('data/kartu-keluarga', AdmKkController::class);
		//warga
		Route::resource('data/warga', AdmWargaController::class);
		//satgas
        Route::resource('data/satgas', AdmSatgasController::class);

		Route::get('logout', [AdmLoginController::class, 'logout'])->name('admin.logout');
	});
});

// satgas-route
Route::group(['prefix' => 'satgas'], function() {
	Route::get('login', [StgLoginController::class, 'showLoginForm'])->name('satgas.login');
	Route::post('login', [StgLoginController::class, 'login'])->name('satgas.post_login');

	Route::group(['middleware' => 'satgas'], function() {
		Route::get('home', [StgHomeController::class, 'index'])->name('satgas.home');

		Route::get('logout', [StgLoginController::class, 'logout'])->name('satgas.logout');
	});
});
