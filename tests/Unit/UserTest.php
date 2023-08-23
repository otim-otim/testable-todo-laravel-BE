<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */


     public function test_if_user_exists(){
        $user = User::factory(User::class)->create(1);

     }
}
