<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;

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

    public function signup(Request $request){
        try {
            $validate = $request->validate([
                'name' => 'required|alpha',
                'email' => 'required|email',
                'password' => 'required|alpha_num|min:8',
                'confirm_password' => 'required|same:password'
            ]);

            if($this->findIfUserExists($request->email)){
                return $this->customFailureResponse('Email already exists', 401);
            }
            $user = $this->storeUser($request->name, $request->email, $request->password);
            return $this->loginUser($request);
        } catch (\Throwable $th) {
            throw $th;
            return $this->customFailureResponse('Internal Server Error', 500);
        }

    }

    public function findIfUserExists($email){
        $user = User::where('email', $email)->first();
        if($user) return true;
        else return false;
    }

    public function storeUser($name, $email, $password){
        try {
            //code...
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);
            if($user) return $user;
            throw new Exception('Could not create user');
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
