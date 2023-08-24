<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function findIfUserExists($email): bool{
        $user = User::where('email', $email)->first();
        if($user) return true;
        else return false;
    }


}
