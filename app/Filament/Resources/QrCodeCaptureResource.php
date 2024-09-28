<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QrCodeCaptureResource\Pages;
use App\Filament\Resources\QrCodeCaptureResource\RelationManagers;
use App\Models\QrCodeCapture;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QrCodeCaptureResource extends Resource
{
    protected static ?string $model = QrCodeCapture::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationGroup = 'Results';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('race.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inscription.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lap')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('checkpoint')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capture_instant')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQRCodeCaptures::route('/'),
        ];
    }
}
