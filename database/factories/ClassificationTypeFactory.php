<?php

namespace Database\Factories;

use App\Models\ClassificationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassificationType>
 */
class ClassificationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
