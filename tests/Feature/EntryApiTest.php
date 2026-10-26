<?php

namespace Tests\Feature;

use App\Models\Contest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_listener_can_enter_an_open_contest(): void
    {
        $contest = Contest::factory()->create();

        $response = $this->postJson("/api/contests/{$contest->id}/entries", [
            'name' => 'Jane Listener',
            'email' => 'jane@example.com',
        ]);

        $response->assertCreated()->assertJsonPath('data.email', 'jane@example.com');
        $this->assertDatabaseHas('entries', ['contest_id' => $contest->id, 'email' => 'jane@example.com']);
    }

    public function test_a_listener_cannot_enter_an_ended_contest(): void
    {
        $contest = Contest::factory()->ended()->create();

        $this->postJson("/api/contests/{$contest->id}/entries", [
            'name' => 'Jane Listener',
            'email' => 'jane@example.com',
        ])->assertUnprocessable();

        $this->assertDatabaseCount('entries', 0);
    }

    public function test_a_listener_cannot_enter_an_upcoming_contest(): void
    {
        $contest = Contest::factory()->upcoming()->create();

        $this->postJson("/api/contests/{$contest->id}/entries", [
            'name' => 'Jane Listener',
            'email' => 'jane@example.com',
        ])->assertUnprocessable();
    }

    public function test_name_and_a_valid_email_are_required(): void
    {
        $contest = Contest::factory()->create();

        $this->postJson("/api/contests/{$contest->id}/entries", ['email' => 'not-an-email'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email']);
    }
}
