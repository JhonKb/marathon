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
        'turns',
        'total_distance_km',
        'status',
        'description'
    ];

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function raceCycle():HasOne
    {
        return $this->hasOne(RaceCycle::class);
    }

    public function inscriptionCaptures(): HasMany
    {
        return $this->hasMany(InscriptionCapture::class);
    }
}
