<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase,InteractsWithDatabase;
    /**
     * A basic unit test example.
     */
    public function test_that_creates_todo(): void
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
        $this->assertInstanceOf(Todo::class, $todo);
        $this->assertEquals($todo->title, 'first todo');
        $this->assertEquals($todo->description, 'this is the todo description');
    }

    public function test_that_deletes_todo(): void{
        $user = User::factory()->create();
        $todo_data = [
            'title' => 'first todo',
            'description' => 'this is the todo description',
            'status' => 'pending',
            'user_id' => $user->id
        ];
        $todo = Todo::factory()
            ->create( $todo_data);
        $todo->delete();
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}
