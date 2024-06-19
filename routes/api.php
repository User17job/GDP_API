<?php

use App\Http\Controllers\Api\trabajosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trabajos', [trabajosController::class, 'getT']);
Route::get('/trabajos/{id}', [trabajosController::class, 'get1T']);
Route::post('/trabajos', [trabajosController::class, 'postT']);
Route::put('/trabajos/{id}', [trabajosController::class, 'putT']);
Route::patch('/trabajos/{id}', [trabajosController::class, 'patchT']);
Route::delete('/trabajos/{id}', [trabajosController::class, 'deleteT']);
