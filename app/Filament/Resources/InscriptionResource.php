<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscriptionResource\Pages;
use App\Filament\Resources\InscriptionResource\RelationManagers;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InscriptionResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('race_id')
                    ->relationship('race', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cpf')
                    ->required()
                    ->mask('999.999.999-99'),
                Forms\Components\DatePicker::make('birthdate')
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->date()
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
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
            'index' => Pages\ListInscriptions::route('/'),
            'create' => Pages\CreateInscription::route('/create'),
        ];
    }
}
