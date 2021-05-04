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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('forgot-password', 'Api\AuthController@forgot_password');

// Route::group(['middleware' => 'auth:api'], function () {
// Route::post('change-password', 'Api\AuthController@change_password');
// });

Route::post('forgot-password', [ForgotPasswordController::class, 'forgot_password']);
    //Route::post('change-password', [ForgotPasswordController::class, 'change_password']);
   Route::post('sendmail', [MailController::class, 'sendEmail']);

Route::middleware(['api'])->group(function ($router) {
   Route::post('register', [RegisterController::class, 'register']);
   Route::post('login', [RegisterController::class, 'login']);
   Route::post('logout', [RegisterController::class, 'logout']);

   // Route::post('change-password', [ForgotPasswordController::class, 'change_password']);
    Route::get('me', [RegisterController::class, 'me']);

   ///branches
    Route::get('branches',   [BrancheController::class, 'index']);
    Route::get('branches/{id}', [BrancheController::class, 'show']);
   ///tasks
   Route::get('mytask',       [TaskController::class, 'index']);
   Route::get('mytask/{id}', [TaskController::class, 'show']);

   ///preparation
   Route::get('preparation', [PreparationController::class, 'index']);

    Route::post('sendPasswordResetLink', [PasswordResetRequestController::class, 'sendEmail']);


    Route::post('resetPassword', [ChangePasswordController::class, 'passwordResetProcess']);



});










// <a target="_blank" rel="noopener noreferrer"
//     href="http://127.0.0.1:8000/response-password-reset?token=%242y%2410%24/xRB7TQNc0QcUTuzHXv4neGeVLna.CeE/RrryY8yNdsdp/.YsFBpC"
