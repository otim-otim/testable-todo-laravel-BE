<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginUser(Request $request){
         $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        $user = Auth::
    }
}
