<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Station>
 */
class StationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Hits', 'Rock', 'Country', 'Talk', 'Jazz']).' '.fake()->randomFloat(1, 88, 108),
            'call_sign' => fake()->unique()->regexify('K[A-Z]{3}'),
            'city' => fake()->city(),
        ];
    }
}
