<?php

namespace App\Filament\Resources;

use App\Filament\Imports\Custom\CustomTableImportAction;
use App\Filament\Imports\Custom\Parsers\SimproParser;
use App\Filament\Imports\Custom\Parsers\Tuss24Parser;
use App\Filament\Imports\SimproImporter;
use App\Filament\Imports\Tuss24Importer;
use App\Filament\Resources\Tuss24Resource\Pages;
use App\Filament\Resources\Tuss24Resource\RelationManagers;
use App\Models\Tuss24;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Tuss24Resource extends Resource
{
    protected static ?string $model = Tuss24::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('display'),
                Tables\Columns\TextColumn::make('observacao'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                CustomTableImportAction::make()
                    ->loadParser(Tuss24Parser::class)
                    ->importer(Tuss24Importer::class)
                    ->csvDelimiter(';')
                    ->setCustomForm([
                        Forms\Components\TextInput::make('observacao'),
                    ])
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
            'index' => Pages\ListTuss24s::route('/'),
            'create' => Pages\CreateTuss24::route('/create'),
            'edit' => Pages\EditTuss24::route('/{record}/edit'),
        ];
    }
}
