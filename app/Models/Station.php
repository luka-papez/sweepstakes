<?php

namespace App\Models;

use Database\Factories\StationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'call_sign', 'city'])]
class Station extends Model
{
    /** @use HasFactory<StationFactory> */
    use HasFactory;

    /**
     * @return HasMany<Contest, $this>
     */
    public function contests(): HasMany
    {
        return $this->hasMany(Contest::class);
    }
}
