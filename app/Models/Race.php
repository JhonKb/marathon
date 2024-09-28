<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_time',
        'laps',
        'checkpoints',
        'total_distance_km',
        'status',
        'description',
        'start_race',
        'end_race',
    ];

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function qrCodeCaptures(): HasMany
    {
        return $this->hasMany(QrCodeCapture::class);
    }
}
