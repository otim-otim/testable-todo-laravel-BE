<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;
class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetch_todos(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        $todo_data = [
            'title' => 'first todo',
            'description' => 'this is the todo description',
            'status' => 'pending',
            'user_id' => $user->id
        ];
        $todo = Todo::factory()
            ->create($todo_data);
        $response = $this->get('api/todos');

        $response->assertStatus(200);
        $response->assert
    }
}
