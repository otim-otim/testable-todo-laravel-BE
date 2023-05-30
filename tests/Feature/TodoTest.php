<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetch_todos(): void
    {
        $todos = Todo::factory()->count(10)->create();
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
