<?php

namespace App\Filament\Resources\Brasindice;

use App\Filament\Imports\Brasindice\OncologicosImporter;
use App\Filament\Imports\Custom\CustomTableImportAction;
use App\Filament\Resources\Brasindice\OncologicosResource\Pages;
use App\Filament\Resources\Brasindice\OncologicosResource\RelationManagers;
use App\Models\Brasindice\Oncologicos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OncologicosResource extends Resource
{
    protected static ?string $model = Oncologicos::class;

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
                Tables\Columns\TextColumn::make('laboratorio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('produto'),
                Tables\Columns\TextColumn::make('aliquota_id')
                    ->label('Alíquota'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                CustomTableImportAction::make()
                    ->importer(OncologicosImporter::class)
                    ->csvDelimiter(',')
                    ->setCustomForm([
                        Forms\Components\TextInput::make('aliquota_id')
                            ->label('Alíquota')
                            ->required(),
                        Forms\Components\Select::make('tipo_brasindice')
                            ->label('Tipo de Tabela')
                            ->options([
                                1 => 'Medicamento',
                                2 => 'Solução'
                            ])
                            ->required(),
                        Forms\Components\Checkbox::make('restrito_hospital')
                            ->label('Restrito Hospital?'),
                        Forms\Components\TextInput::make('versao_update')
                            ->label('Versão baixada')
                            ->required(),
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
            'index' => Pages\ListOncologicos::route('/'),
            'create' => Pages\CreateOncologicos::route('/create'),
            'edit' => Pages\EditOncologicos::route('/{record}/edit'),
        ];
    }
}
