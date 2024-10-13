<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncouragementController;
use App\Http\Controllers\SportCategoryController;
use App\Http\Controllers\ExerciseController;

Route::post('login', [UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:api');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');




Route::post('register/user',[UserController::class,'store']);
Route::get('users',[UserController::class,'index']);

Route::apiResource('encouragements', EncouragementController::class);

Route::apiResource('sport-categories', SportCategoryController::class);


Route::post('/store/exercises', [ExerciseController::class, 'store']);
Route::get('/videos/{id}/url', [ExerciseController::class, 'getVideoUrl']); //PLAY THE VIDEO
Route::apiResource('exercises', ExerciseController::class);









Route::get('clients',[UserAuthController::class,'index']);

use App\Http\Controllers\CommentController;

Route::apiResource('comments', CommentController::class);


use App\Http\Controllers\ComponentController;

Route::apiResource('components', ComponentController::class);

use App\Http\Controllers\DietController;

Route::apiResource('diets', DietController::class);




use App\Http\Controllers\GuideController;

Route::apiResource('guides', GuideController::class);

use App\Http\Controllers\MarketPlaceController;

Route::apiResource('marketplaces', MarketPlaceController::class);

use App\Http\Controllers\MealController;

Route::apiResource('meals', MealController::class);

use App\Http\Controllers\MealCategoryController;

Route::apiResource('meal-categories', MealCategoryController::class);

use App\Http\Controllers\MenuController;

Route::apiResource('menus', MenuController::class);



use App\Http\Controllers\TestimonyController;

Route::apiResource('testimonies', TestimonyController::class);

use App\Http\Controllers\SportExerciseController;

Route::apiResource('sport-exercises', SportExerciseController::class);















