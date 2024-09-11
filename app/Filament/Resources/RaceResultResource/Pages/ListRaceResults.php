<?php

namespace App\Filament\Resources\RaceResultResource\Pages;

use App\Filament\Resources\RaceResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRaceResults extends ListRecords
{
    protected static string $resource = RaceResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
