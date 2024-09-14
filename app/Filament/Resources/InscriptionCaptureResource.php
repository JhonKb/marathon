<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaceResultResource\Pages;
use App\Filament\Resources\RaceResultResource\RelationManagers;
use App\Models\InscriptionCapture;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscriptionCaptureResource extends Resource
{
    protected static ?string $model = InscriptionCapture::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Management';

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
                Tables\Columns\TextColumn::make('turn')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capture_instant')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('turn_result'),
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
            'index' => Pages\ListInscriptionCaptures::route('/'),
        ];
    }
}
