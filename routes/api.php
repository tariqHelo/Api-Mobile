<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\BrancheController;



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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('forgot-password', 'Api\AuthController@forgot_password');

// Route::group(['middleware' => 'auth:api'], function () {
// Route::post('change-password', 'Api\AuthController@change_password');
// });

Route::post('forgot-password', [ForgotPasswordController::class, 'forgot_password']);
    //Route::post('change-password', [ForgotPasswordController::class, 'change_password']);

Route::middleware(['api'])->group(function () {
   Route::post('register', [RegisterController::class, 'register']);
   Route::post('login', [RegisterController::class, 'login']);
   Route::post('logout', [RegisterController::class, 'logout']);

    Route::post('change-password', [ForgotPasswordController::class, 'change_password']);
    Route::get('me', [RegisterController::class, 'me']);

   ///branches
    Route::get('branches',   [BrancheController::class, 'index']);
   ///tasks
   Route::get('tasks',       [TaskController::class, 'index']);
   ///preparation
   Route::get('preparation', [PreparationController::class, 'index']);

});
