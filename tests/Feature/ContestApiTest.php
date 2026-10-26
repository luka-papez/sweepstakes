<?php

namespace Tests\Feature;

use App\Models\Contest;
use App\Models\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContestApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_contests_with_their_entry_counts(): void
    {
        $contest = Contest::factory()->create();
        Entry::factory()->count(3)->for($contest)->create();
        Contest::factory()->ended()->create();

        $response = $this->getJson('/api/contests');

        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.1.id', $contest->id)
            ->assertJsonPath('data.1.entries_count', 3)
            ->assertJsonPath('data.1.station', $contest->station->name);
    }

    public function test_it_shows_a_single_contest(): void
    {
        $contest = Contest::factory()->ended()->create();

        $this->getJson("/api/contests/{$contest->id}")
            ->assertOk()
            ->assertJsonPath('data.title', $contest->title)
            ->assertJsonPath('data.status', 'ended');
    }

    public function test_it_returns_404_for_unknown_contest(): void
    {
        $this->getJson('/api/contests/999')->assertNotFound();
    }
}
