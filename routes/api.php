<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\PasswordResetRequestController;
use App\Http\Controllers\Api\ChangePasswordController;



use App\Http\Controllers\BrancheController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PreparationController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\MailController;


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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('sendmail', [PasswordResetRequestController::class, 'sendEmail']);

Route::post('login', [RegisterController::class, 'login']);

Route::post('register', [RegisterController::class, 'register']);


Route::middleware(['api'])->group(function ($router) {
   Route::post('logout', [RegisterController::class, 'logout']);
    
    //profile
    Route::get('me', [RegisterController::class, 'me']);

    ///branches
    Route::get('branches',   [BrancheController::class, 'index']);
    Route::get('branches/{id}', [BrancheController::class, 'show']);
    ///tasks
    Route::get('mytask',       [TaskController::class, 'index']);
    Route::post('mytask',      [TaskController::class, 'store']);
    Route::get('mytask/{id}',  [TaskController::class, 'show']);
    Route::post('mytask/{id}', [TaskController::class, 'update']);
   ///preparation
    Route::get('preparation', [PreparationController::class, 'index']);
    ///products
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);


    Route::post('sendPasswordResetLink', [PasswordResetRequestController::class, 'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class, 'passwordResetProcess']);

});
