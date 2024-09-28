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

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function qrCodeCaptures(): HasMany
    {
        return $this->hasMany(QrCodeCapture::class);
    }

    public function calculateTotalTime()
    {
         return QrCodeCapture::query()->where('inscription_id', $this->id)->sum('time') ?? null;
    }
}
