<?php

namespace App\Filament\Resources\QrCodeCaptureResource\Pages;

use App\Filament\Resources\QrCodeCaptureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQrCodeCaptures extends ListRecords
{
    protected static string $resource = QrCodeCaptureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
