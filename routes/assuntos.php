<?php

use App\Http\Controllers\AssuntoController;
use Illuminate\Support\Facades\Route;

Route::get('assuntos', [AssuntoController::class, 'index']);
Route::post('assuntos', [AssuntoController::class, 'store']);
Route::delete('assuntos/{id}', [AssuntoController::class, 'destroy']);
Route::get('/assuntos/{id}', [AssuntoController::class, 'show']);
Route::put('/assuntos/{id}', [AssuntoController::class, 'update']);
