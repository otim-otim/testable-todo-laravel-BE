<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginUser(Request $request){
        try {
            //code...
            $request->validate([
               'email' => 'required|email|max:255',
               'password' => 'required',
           ]);
           $credentials = $request->only('email', 'password');

           if (Auth::attempt($credentials)) {
               $user = User::where('email', $request->email)->first();
               $token = $user->createToken('authToken')->plainTextToken;

               return $this->customSuccessResponse([
                   'token' => $token,
                   'user' => $user,
                   'message' => "welcome $user->name"
               ]);
           } else {
               return $this->customFailureResponse(['message' => 'Unauthorized'], 401);
           }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->customFailureResponse(['message' => 'Internal Server Error'], 500);
        }

    }
}
