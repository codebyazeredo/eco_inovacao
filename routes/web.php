<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio.index');
});

Route::get('/dashboard/produtor', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/inicio', function () {
    return view('inicio.index');
})->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('eventos', EventoController::class);

require __DIR__.'/auth.php';
require  __DIR__.'/assuntos.php';
