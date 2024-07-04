<?php

use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:api');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('register',[UserAuthController::class,'store']);
Route::get('clients',[UserAuthController::class,'index']);
