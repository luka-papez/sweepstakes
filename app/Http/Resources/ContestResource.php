<?php

namespace App\Http\Resources;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Contest
 */
class ContestResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'prize' => $this->prize,
            'station' => $this->station->name,
            'status' => $this->status(),
            'starts_at' => $this->starts_at->toIso8601String(),
            'ends_at' => $this->ends_at->toIso8601String(),
            'entries_count' => $this->entries()->count(),
        ];
    }
}
