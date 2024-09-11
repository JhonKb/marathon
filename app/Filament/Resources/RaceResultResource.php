<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaceResultResource\Pages;
use App\Filament\Resources\RaceResultResource\RelationManagers;
use App\Models\RaceResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaceResultResource extends Resource
{
    protected static ?string $model = RaceResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('race_id')
                    ->relationship('race', 'name')
                    ->required(),
                Forms\Components\Select::make('inscription_id')
                    ->relationship('inscription', 'name')
                    ->required(),
                Forms\Components\TextInput::make('turn')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('capture_instant')
                    ->required(),
                Forms\Components\TextInput::make('turn_result')
                    ->required(),
            ]);
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
            'index' => Pages\ListRaceResults::route('/'),
            'create' => Pages\CreateRaceResult::route('/create'),
            'edit' => Pages\EditRaceResult::route('/{record}/edit'),
        ];
    }
}
