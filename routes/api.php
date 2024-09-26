<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CommandeController;

// Routes pour les clients
Route::post('/clients', [ClientController::class, 'store']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

// Routes pour les commandes
Route::post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes', [CommandeController::class, 'index']);
Route::put('/commandes/{id}', [CommandeController::class, 'update']);
Route::get('/commandes/{id}', [CommandeController::class, 'show']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
