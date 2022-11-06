<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todolist>
 */
class TodolistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Melakukan apa yang aada didalam DatabaseSeeder
            // mt_rand adalah fungsi random
            'title' => $this->faker->sentence(mt_rand(1,3)),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'user_id' => mt_rand(1,2),
            'category_id' => mt_rand(1,2),
            'due' => $this->faker->dateTime(),
            'status' =>  'Unfinished'
        ];
    }
}
