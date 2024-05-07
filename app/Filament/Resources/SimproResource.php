<?php

namespace App\Filament\Resources;

use App\Filament\Imports\Custom\CustomImportAction;
use App\Filament\Imports\Custom\CustomTableImportAction;
use App\Filament\Imports\Custom\Parsers\SimproParser;
use App\Filament\Imports\SimproImporter;
use App\Filament\Resources\SimproResource\Pages;
use App\Filament\Resources\SimproResource\RelationManagers;
use App\Models\Simpro;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SimproResource extends Resource
{
    protected static ?string $model = Simpro::class;

    protected static ?string $navigationGroup = 'Tabelas';

    protected static ?string $pluralLabel = 'Tabela Simpro';

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
                Tables\Columns\TextColumn::make('codigoUsuario'),
                Tables\Columns\TextColumn::make('versao'),
                Tables\Columns\TextColumn::make('descricao'),
                Tables\Columns\TextColumn::make('precoFabrica')
                    ->money('BRL')
            ])
            ->headerActions([
                CustomTableImportAction::make()
                    ->loadParser(SimproParser::class)
                    ->importer(SimproImporter::class)
                    ->csvDelimiter(';')
                    ->setCustomForm([
                        Forms\Components\TextInput::make('versao')
                            ->required(),
                    ])
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
            'index' => Pages\ListSimpros::route('/'),
            'create' => Pages\CreateSimpro::route('/create'),
            'edit' => Pages\EditSimpro::route('/{record}/edit'),
        ];
    }
}
