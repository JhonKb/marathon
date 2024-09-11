<?php

namespace App\Filament\Resources\RaceCycleResource\Pages;

use App\Filament\Resources\RaceCycleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRaceCycle extends EditRecord
{
    protected static string $resource = RaceCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
