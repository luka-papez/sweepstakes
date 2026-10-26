<?php

namespace Tests\Unit;

use App\Models\Contest;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ContestTest extends TestCase
{
    /**
     * @return array<string, array{string, string, string, bool}>
     */
    public static function windows(): array
    {
        return [
            'upcoming' => ['+1 day', '+2 days', 'upcoming', false],
            'open' => ['-1 day', '+1 day', 'open', true],
            'ended' => ['-2 days', '-1 day', 'ended', false],
        ];
    }

    #[DataProvider('windows')]
    public function test_status_depends_on_the_entry_window(string $start, string $end, string $status, bool $open): void
    {
        $contest = new Contest;
        $contest->starts_at = new \DateTimeImmutable($start);
        $contest->ends_at = new \DateTimeImmutable($end);

        $this->assertSame($status, $contest->status());
        $this->assertSame($open, $contest->isOpen());
    }
}
