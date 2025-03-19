<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


route::post('/users/register', [UserController::class, 'register'])->name('api.register');
route::post('/users/login', [UserController::class, 'login'])->name('api.login');
Route::post('/users/upload-image', [UserController::class, 'uploadImage'])->middleware('auth:sanctum');





Route::middleware('auth:sanctum')->group(function () {
    route::get('/users', [UserController::class, 'index']);
    route::patch('/users/{id}', [UserController::class, 'update']);
    route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/me', [UserController::class, 'me']);
    Route::post('/users/logout', [UserController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
