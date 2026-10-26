<?php

namespace App\Models;

use Database\Factories\ContestFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['station_id', 'title', 'prize', 'starts_at', 'ends_at'])]
class Contest extends Model
{
    /** @use HasFactory<ContestFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Station, $this>
     */
    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    /**
     * @return HasMany<Entry, $this>
     */
    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function isOpen(): bool
    {
        return now()->between($this->starts_at, $this->ends_at);
    }

    public function status(): string
    {
        return match (true) {
            now()->lt($this->starts_at) => 'upcoming',
            now()->gt($this->ends_at) => 'ended',
            default => 'open',
        };
    }
}
