<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use Faker\Generator as Faker;
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(Task::class, function (Faker $faker) {
            return [
                'title' => $faker->paragraph,
                'user_id' => 1
            ];
        });
    }
}
