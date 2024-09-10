<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RaceResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'inscription_id',
        'turn',
        'capture_instant',
        'turn_result'
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }
}
