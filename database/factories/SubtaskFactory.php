<?php

namespace Database\Factories;

use App\Models\Subtask;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubtaskFactory extends Factory
{
    protected $model = Subtask::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'is_done' => $this->faker->boolean,
            'task_id' => \App\Models\Task::factory(),
        ];
    }
}