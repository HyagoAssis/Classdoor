<?php

namespace Database\Factories;

use App\Models\{Classification, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'            => 1,
            'classification_id' => Classification::factory(),
            'complaint'         => $this->faker->sentence(),
            'user_id'           => User::factory(),
        ];
    }
}
