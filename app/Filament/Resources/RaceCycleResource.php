<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaceCycleResource\Pages;
use App\Filament\Resources\RaceCycleResource\RelationManagers;
use App\Models\RaceCycle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaceCycleResource extends Resource
{
    protected static ?string $model = RaceCycle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('race_id')
                    ->relationship('race', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_race')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_race'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('race.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_race')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_race')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListRaceCycles::route('/'),
            'create' => Pages\CreateRaceCycle::route('/create'),
            'edit' => Pages\EditRaceCycle::route('/{record}/edit'),
        ];
    }
}
