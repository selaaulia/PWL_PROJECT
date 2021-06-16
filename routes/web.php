<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/profile', UserController::class);

    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index']);

            //CRUD Anggota
            Route::get('/anggota/cari/', [AnggotaController::class, 'search']);
            Route::resource('/anggota', AnggotaController::class);

            //CRUD Buku
            Route::get('/buku/cari/', [BukuController::class, 'search']);
            Route::resource('/buku', BukuController::class);
        });
    });

    Route::middleware(['petugas'])->group(function () {
        Route::prefix('petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'index']);
            //CRUD Anggota
            Route::get('/anggota/cari/', [AnggotaController::class, 'search']);
            Route::resource('/anggota', AnggotaController::class);

            //CRUD Buku
            Route::get('/buku/cari/', [BukuController::class, 'search']);
            Route::resource('/buku', BukuController::class);
        });
    });

    Route::middleware(['anggota'])->group(function () {
        Route::prefix('anggota')->group(function () {
            Route::get('/', [AnggotaController::class, 'home']);

            //DATA Buku
            Route::get('/buku', [AnggotaController::class, 'buku']);
            Route::get('/buku/{id}', [AnggotaController::class, 'lihatbuku']);
        });
    });

    Route::get('/logout', function () {
        Auth::logout();
        redirect('/');
    });
});
