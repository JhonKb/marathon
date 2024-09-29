<?php

namespace App\Filament\Pages;

use App\Models\Race;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class RacingPanel extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static ?string $navigationGroup = 'Races';

    protected static string $view = 'filament.pages.racing-panel';

    /**
     * @return Collection
     */
    public function getRaces(): Collection
    {
        return Race::all();
    }
}
