<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Entry;
use App\Models\Station;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kzht = Station::factory()->create(['name' => 'KZHT 97.1 Hits', 'call_sign' => 'KZHT', 'city' => 'Salt Lake City']);
        $kbzn = Station::factory()->create(['name' => 'KBZN 97.9 Jazz', 'call_sign' => 'KBZN', 'city' => 'Salt Lake City']);
        $wxyz = Station::factory()->create(['name' => 'WXYZ Channel 7', 'call_sign' => 'WXYZ', 'city' => 'Detroit']);

        $contests = [
            Contest::factory()->for($kzht)->create(['title' => 'Taylor Swift Ticket Drop', 'prize' => '2 floor tickets']),
            Contest::factory()->for($kzht)->create(['title' => 'Fill Up Fridays', 'prize' => '$100 gas card']),
            Contest::factory()->for($kbzn)->ended()->create(['title' => 'Jazz Fest VIP Weekend', 'prize' => '2 VIP passes']),
            Contest::factory()->for($wxyz)->ended()->create(['title' => 'Football Pick\'em Week 6', 'prize' => '$1,000 cash']),
            Contest::factory()->for($wxyz)->upcoming()->create(['title' => 'Holiday Shopping Spree', 'prize' => '$2,500 mall gift card']),
        ];

        foreach ($contests as $contest) {
            if ($contest->status() !== 'upcoming') {
                Entry::factory()->count(fake()->numberBetween(5, 40))->for($contest)->create();
            }
        }
    }
}
