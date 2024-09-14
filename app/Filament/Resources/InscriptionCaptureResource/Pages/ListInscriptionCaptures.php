<?php

namespace App\Filament\Resources\InscriptionCaptureResource\Pages;

use App\Filament\Resources\InscriptionCaptureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscriptionCaptures extends ListRecords
{
    protected static string $resource = InscriptionCaptureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
