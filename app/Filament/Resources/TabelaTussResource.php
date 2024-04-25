<?php

namespace App\Filament\Resources;

use App\Filament\Imports\TabelaTussImporter;
use App\Filament\Resources\TabelaTussResource\Pages;
use App\Filament\Resources\TabelaTussResource\RelationManagers;
use App\Models\TabelaTuss;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TabelaTussResource extends Resource
{
    protected static ?string $model = TabelaTuss::class;

    protected static ?string $pluralLabel = 'Tabela TUSS 20';

    protected static ?string $navigationGroup = 'Tabelas';

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
                Tables\Columns\TextColumn::make('cod_termo'),
                Tables\Columns\TextColumn::make('termo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apresentacao')
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(TabelaTussImporter::class)
                    ->csvDelimiter(';')
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
            'index' => Pages\ListTabelaTusses::route('/'),
            'create' => Pages\CreateTabelaTuss::route('/create'),
            'edit' => Pages\EditTabelaTuss::route('/{record}/edit'),
        ];
    }
}
