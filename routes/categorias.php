<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias', [CategoriaController::class, 'store']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);
Route::get('categorias/{id}', [CategoriaController::class, 'show']);
Route::put('categorias/{id}', [CategoriaController::class, 'update']);
