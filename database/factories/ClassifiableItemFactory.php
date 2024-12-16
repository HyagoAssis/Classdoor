<?php

namespace Database\Factories;

use App\Models\{ClassifiableItem, ClassificationType, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassifiableItem>
 */
class ClassifiableItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                   => $this->faker->name(),
            'classification_type_id' => ClassificationType::factory()->create()->id,
            'created_by'             => User::factory()->create(),
        ];
    }
}
