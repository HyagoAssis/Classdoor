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
            'value'                => $this->faker->numberBetween(0, 5),
            'comment'              => $this->faker->text(),
        ];
    }

    public function teacherClassifications(): ClassificationFactory|Factory
    {
        return $this->state(fn (array $attributes) => [
            'classifiable_item_id' => ClassifiableItem::factory()->create(['classification_type_id' => 1]),
        ]);
    }

    public function disciplineClassifications(): ClassificationFactory|Factory
    {
        return $this->state(fn (array $attributes) => [
            'classifiable_item_id' => ClassifiableItem::factory()->create(['classification_type_id' => 2]),
        ]);
    }

    public function placeClassifications(): ClassificationFactory|Factory
    {
        return $this->state(fn (array $attributes) => [
            'classifiable_item_id' => ClassifiableItem::factory()->create(['classification_type_id' => 3]),
        ]);
    }
}
