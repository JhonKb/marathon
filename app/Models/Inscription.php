<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'name',
        'cpf',
        'birthdate'
    ];

    /**
     * @return BelongsTo
     */
    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * @return HasMany
     */
    public function qrCodeCaptures(): HasMany
    {
        return $this->hasMany(QrCodeCapture::class);
    }

    /**
     * @return string
     */
    public function calculateTotalTime(): string
    {
        $totalMilliseconds = $this->qrCodeCaptures->reduce(function ($carry, $capture) {
        list($hours, $minutes, $seconds, $milliseconds) = sscanf($capture->time, '%d:%d:%d.%d');
        return $carry + ($hours * 3600000) + ($minutes * 60000) + ($seconds * 1000) + $milliseconds;
    }, 0);

    $hours = floor($totalMilliseconds / 3600000);
    $minutes = floor(($totalMilliseconds % 3600000) / 60000);
    $seconds = floor(($totalMilliseconds % 60000) / 1000);
    $milliseconds = $totalMilliseconds % 1000;

    return sprintf('%02d:%02d:%02d.%03d', $hours, $minutes, $seconds, $milliseconds);
    }

    /**
     * @return int
     */
    public function getLastCheckpointCaptured(): int
    {
        $lastCapture = $this->qrCodeCaptures()->latest()->first();
        return $lastCapture ? $lastCapture->checkpoint: 0;
    }

    /**
     * @return int
     */
    public function getLastLapCaptured(): int
    {
        $lastCapture = $this->qrCodeCaptures()->latest()->first();
        return $lastCapture ? $lastCapture->lap: 0;
    }
}
