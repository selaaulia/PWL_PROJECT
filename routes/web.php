<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;


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

//BukuAdmin
Route::get('buku/cari/',[BukuController::class, 'search']);
Route::resource('buku', BukuController::class);

Route::get('/', function () {
    return view('welcome');
});
