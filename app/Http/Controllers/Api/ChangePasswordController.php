<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function passwordResetProcess(Request $request){

      $validator = \Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|confirmed'
      ]);
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) :
        $this->tokenNotFoundError();
      }
  
      // Verify if token is valid
      private function updatePasswordRow($request){
         return DB::table('password_resets')->where([
             'email' => $request->email,
             'token' => $request->resetToken
         ]);
      }
  
      // Token not found response  
      private function tokenNotFoundError() {
          return response()->json([
            'error' => 'Either your email or token is wrong.'
          ],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
  
      // Reset password
      private function resetPassword($request) {
          // find email
          $userData = User::whereEmail($request->email)->first();
          // update password
          $userData->update([
            'password'=>bcrypt($request->password)
          ]);
          // remove verification data from db
          $this->updatePasswordRow($request)->delete();
  
          // reset password response
          return response()->json([
            'data'=>'Password has been updated.'
          ],Response::HTTP_CREATED);
      }    
}
// <a target="_blank" rel="noopener noreferrer"
//     href="http://127.0.0.1:8000/response-password-reset?token=%242y%2410%24/xRB7TQNc0QcUTuzHXv4neGeVLna.CeE/RrryY8yNdsdp/.YsFBpC"
