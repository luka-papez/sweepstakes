<?php

namespace Database\Factories;

use App\Models\Contest;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contest>
 */
class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'station_id' => Station::factory(),
            'title' => fake()->catchPhrase().' Giveaway',
            'prize' => fake()->randomElement(['2 concert tickets', '$500 gas card', 'Weekend in Vegas', 'Signed guitar']),
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addWeek(),
        ];
    }

    public function ended(): static
    {
        return $this->state(fn () => [
            'starts_at' => now()->subWeeks(2),
            'ends_at' => now()->subDay(),
        ]);
    }

    public function upcoming(): static
    {
        return $this->state(fn () => [
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addWeeks(2),
        ]);
    }
}
