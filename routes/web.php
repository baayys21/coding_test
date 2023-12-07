<?php

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
    return view('welcome');
});

Auth::routes();

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/kendaraan/manajemen/', [App\Http\Controllers\KendaraanController::class, 'index']);
Route::post('/kendaraan/manajemen/store', [App\Http\Controllers\KendaraanController::class, 'store']);
Route::post('/kendaraan/rent/store', [App\Http\Controllers\KendaraanController::class, 'rent']);
Route::get('/kendaraan/return', [App\Http\Controllers\KendaraanController::class, 'return']);

Route::post('/kendaraan/getlistvehicle', [App\Http\Controllers\KendaraanController::class, 'getListVehicle']);
