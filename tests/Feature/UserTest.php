<?php

namespace Tests\Feature;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */


    public function test_creates_a_user(): void
    {
        $response = $this->post('api/register',[
            'name' => 'lintonmarley',
            'email' => 'lintonmarley@gmail.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ]);
        $response->assertStatus(200);
    }
}
