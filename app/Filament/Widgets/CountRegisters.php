<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use App\Models\QrCodeCapture;
use App\Models\Race;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CountRegisters extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Races', Race::all()->count()),
            Stat::make('Total Inscriptions', Inscription::all()->count()),
            Stat::make('Total Captures', QrCodeCapture::all()->count()),
        ];
    }
}
