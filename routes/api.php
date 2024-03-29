<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todos',[TodoController::class,'index']);
    Route::post('/todos-create',[TodoController::class,'store']);
});


Route::post('/register',[AuthController::class, 'signup']);
Route::post('/login',[AuthController::class, 'loginUser']);

