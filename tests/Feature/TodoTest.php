<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\UserService;
use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;
class TodoTest extends TestCase
{
    use RefreshDatabase,InteractsWithDatabase;
    /**
     * A basic feature test example.
     */
    public function test_only_logged_in_user_can_fetch_todos(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        // $todos = Todo::factory()->count(5)->create();
        // $user = User::factory()
        //     ->hasTodos(5)
        //     ->create();
        $todo_data = [
            'title' => 'first todo',
            'description' => 'this is the todo description',
            'status' => 'pending',
            'user_id' => $user->id
        ];
        $todos = Todo::factory()
            ->count(5)
            ->create($todo_data);
        $response = $this->actingAs($user)->getJson('api/todos');
        $response->assertStatus(200);
        // $response->assert
    }

    public function test_non_logged_in_user_cannot_fetch_todos()
    {
        $user = User::factory()->create();
        $todo_data = [
            'title' => 'first todo',
            'description' => 'this is the todo description',
            'status' => 'pending',
            'user_id' => $user->id
        ];
        $todos = Todo::factory()
            ->count(5)
            ->create($todo_data);
        $response = $this->getJson('api/todos');
        $response->assertStatus(401);
    }

    public function test_user_can_store_todo(){
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





    }

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
