<?php

namespace Tests\Feature;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Services\UserService;
class UserTest extends TestCase
{
    use RefreshDatabase;


    public function test_creates_a_user(): void
    {
        $response = $this->postJson('api/register',[
            'name' => 'linton marley',
            'email' => 'lintonmarley@gmail.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ]);
        $response->assertStatus(200);
    }

    public function test_signup_user_already_exists(){

        $user = User::factory()->create();
        $service = new UserService();

        $isUserExists = $service->findIfUserExists($user->email);

        $this->assertTrue($isUserExists);



     }

     public function test_signup_user_doesnt_exist(){

        $user = User::factory()->make();
        $service = new UserService();

        $isUserExists = $service->findIfUserExists($user->email);

        $this->assertFalse($isUserExists);

     }

     public function test_a_user_can_login() {
        $user = User::factory()->create(['password' => 'password']);

        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
     }

     public function test_non_registered_user_cant_login(){
        $user = User::factory()->make();

        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(401);
     }

     public function test_a_user_with_wrong_password_cant_login(){
        $user = User::factory()->create(['password' => 'password']);

        $response = $this->postJson('api/login', [
            'email' => $user->email,
            'password' => 'password2'
        ]);

        $response->assertStatus(401);
     }
}
