<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio.index');
});

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->get('/dashboard/admin', function () {
    return view('area-admin.dashboard');
})->name('admin.dashboard');

Route::get('/dashboard/produtor', function () {
    return view('area-produtor.dashboard');
})->middleware('auth')->name('produtor.dashboard');

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
