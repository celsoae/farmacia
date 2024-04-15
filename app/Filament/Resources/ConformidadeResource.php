<?php

namespace App\Filament\Resources;

use App\Filament\Imports\ConformidadeImporter;
use App\Filament\Resources\ConformidadeResource\Pages;
use App\Filament\Resources\ConformidadeResource\RelationManagers;
use App\Models\Conformidade;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConformidadeResource extends Resource
{
    protected static ?string $model = Conformidade::class;

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
                Tables\Columns\TextColumn::make('SUBSTANCIA')
                    ->label('Substância')
                    ->searchable(),
                Tables\Columns\TextColumn::make('PRODUTO')
                    ->label('Produto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('APRESENTACAO')
                    ->label('Apresentação')
                    ->searchable(),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(ConformidadeImporter::class)
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
            'index' => Pages\ListConformidades::route('/'),
            'create' => Pages\CreateConformidade::route('/create'),
            'edit' => Pages\EditConformidade::route('/{record}/edit'),
        ];
    }
}
