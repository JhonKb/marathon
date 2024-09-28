<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;

class PlayRace extends Page
{
    protected static string $view = 'filament.pages.play-race';

    protected static bool $shouldRegisterNavigation = false;
}
