<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPhoneController;
use App\Http\Controllers\ContactEmailController;

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

Route::prefix('/contacts')->group(function (){
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'store']);
    Route::get('/{id}', [ContactController::class, 'show']);
    Route::match(['put', 'patch'],'/{id}', [ContactController::class, 'update']);
    Route::delete('/{id}', [ContactController::class, 'delete']);
});

Route::prefix('/contacts/phone')->group(function (){
    Route::post('/', [ContactPhoneController::class, 'store']);
    Route::match(['put', 'patch'],'/{id}', [ContactPhoneController::class, 'update']);
    Route::delete('/{id}', [ContactPhoneController::class, 'delete']);
});

Route::prefix('/contacts/email')->group(function (){
    Route::post('/', [ContactEmailController::class, 'store']);
    Route::match(['put', 'patch'],'/{id}', [ContactEmailController::class, 'update']);
    Route::delete('/{id}', [ContactEmailController::class, 'delete']);
});
