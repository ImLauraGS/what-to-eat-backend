<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\FavoriteController;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/add', [RecipeController::class, 'store']);
    Route::get('/recipes' , [RecipeController::class, 'index']);
    Route::get('/recipe/{id}' , [RecipeController::class, 'getRecipe']);
    Route::put('/recipe/{id}' , [RecipeController::class, 'update']);
    Route::delete('/recipe/{id}' , [RecipeController::class, 'destroy']);
    Route::get('/favorites/{user_id}', [FavoriteController::class, 'index']);
    Route::post('/recipe/{id}', [FavoriteController::class, 'store']); 
    Route::delete('/favorites/{user_id}/{recipe_id}', [FavoriteController::class, 'destroy']);
});
