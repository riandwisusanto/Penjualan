<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabarugiController;
use App\Http\Controllers\PenjualanController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('register', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('logout', [AuthController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/barang', BarangController::class);
    Route::resource('/penjualan', PenjualanController::class);
    Route::get('/labarugi', [LabarugiController::class, 'index']);
    Route::resource('/pengaturan', ConfigController::class);
});
