<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{

    // protected $model = Todo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => fake()->words(3),
            'description' => fake()->sentences(4),
            'status' => fake()->randomElement(['pending', 'done','cancelled','delayed','doing']),
            // 'user_id' => User::factory(),

            // 'title' => $this->faker->words(3, true),
            // 'description' => $this->faker->sentences(4, true),
            // 'status' => $this->faker->randomElement(['pending', 'done', 'cancelled', 'delayed', 'doing']),
            // 'user_id' => rand(1, 100)
        ];


    }



}
