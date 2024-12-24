<?php

namespace Database\Factories;

use App\Models\{ClassifiableItem, Classification, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classification>
 */
class ClassificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'              => User::factory(),
            'classifiable_item_id' => ClassifiableItem::factory(),
            'value'                => $this->faker->randomNumber(1),
            'comment'              => $this->faker->text(),
        ];
    }
}
