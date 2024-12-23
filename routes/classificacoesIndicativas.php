<?php

use App\Http\Controllers\ClassificacaoIndicativaController;
use Illuminate\Support\Facades\Route;

Route::get('classificacoes', [ClassificacaoIndicativaController::class, 'index']);
Route::post('classificacoes', [ClassificacaoIndicativaController::class, 'store']);
Route::delete('classificacoes/{id}', [ClassificacaoIndicativaController::class, 'destroy']);
Route::get('classificacoes/{id}', [ClassificacaoIndicativaController::class, 'show']);
Route::put('classificacoes/{id}', [ClassificacaoIndicativaController::class, 'update']);
