<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
// [1] Panggil Manajernya di bagian atas file
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontEndController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CategoryController::class, 'index']);

    Route::get('/dashboard/category/create', [CategoryController::class, 'create']);

    // [4] Jalur rahasia pengiriman data dari form ke gudang (POST) 
    Route::post('/dashboard/category/store', [CategoryController::class, 'store']);

    Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit']);
    // Jalur untuk memproses penyimpanan data yang di-edit (Perhatikan method PUT)
    Route::put('/kategori/{category}', [CategoryController::class, 'update']);
    // Jalur untuk memproses penghapusan data (Perhatikan method DELETE)
    Route::delete('/kategori/{category}', [CategoryController::class, 'destroy']);

    // [2] Daftarkan jalurnya di bagian bawah file
    Route::get('/event/create', [EventController::class, 'create']);
    Route::post('/event/store', [EventController::class, 'store']);

    Route::get('/events', [EventController::class, 'index']);

    Route::get('/event/{event}/edit', [EventController::class, 'edit']);
    Route::put('/event/{event}', [EventController::class, 'update']);
    Route::delete('/event/{event}', [EventController::class, 'destroy']);
});

Route::get('/', [FrontEndController::class, 'index']);
Route::get('/event/{id}', [FrontEndController::class, 'show'])->name('event.show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
