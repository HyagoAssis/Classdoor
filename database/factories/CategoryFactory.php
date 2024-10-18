<?php

namespace Database\Factories;

use App\Models\{Category, ClassificationType};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                   => $this->faker->word(),
            'classification_type_id' => ClassificationType::factory(),
        ];
    }
}
