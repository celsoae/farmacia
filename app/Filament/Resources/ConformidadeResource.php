<?php

namespace App\Filament\Resources;

use App\Filament\Imports\ConformidadeImporter;
use App\Filament\Resources\ConformidadeResource\Custom\CustomBulkSelect;
use App\Filament\Resources\ConformidadeResource\Pages;
use App\Filament\Resources\ConformidadeResource\RelationManagers;
use App\Models\Conformidade;
use App\Models\Simpro;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Livewire;

class ConformidadeResource extends Resource
{
    protected static ?string $model = Conformidade::class;
    protected static ?string $label = 'CMED';
    protected static ?string $pluralLabel = 'CMED';

    protected static ?string $navigationGroup = 'Tabelas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public $viewRecords;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('PRODUTO')
                    ->label('Produto'),
                Forms\Components\TextInput::make('SUBSTANCIA')
                    ->label('Substância'),
                Forms\Components\TextInput::make('APRESENTACAO')
                    ->label('Apresentação')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('PRODUTO')
                    ->label('Produto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SUBSTANCIA')
                    ->label('Substância')
                    ->searchable(),
                Tables\Columns\TextColumn::make('APRESENTACAO')
                    ->label('Apresentação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TIPO_PRODUTO')
                    ->label('Tipo do Produto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('RESTRICAO_HOSPITALAR')
                    ->label('Restrito Hosp.')
                    ->searchable(),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(ConformidadeImporter::class)
                    ->csvDelimiter(';'),
            ])
            ->filters([
                Tables\Filters\Filter::make('RESTRICAO_HOSPITALAR')
                    ->label('Restrito Hospital')
                    ->query(fn(Builder $query): Builder => $query->where('RESTRICAO_HOSPITALAR', 'Sim'))
                    ->toggle(),
                Tables\Filters\SelectFilter::make('TIPO_PRODUTO')
                    ->label('Tipo do Produto')
                    ->options(Conformidade::selectRaw('DISTINCT TIPO_PRODUTO')->get())
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                    ->label('detalhes')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('compare')
                    ->modalContent(function ($records) {
                        $sugestoes = Conformidade::whereIn('id', $records->pluck('id')->all())->get();

                        return view('filament.modal.comparativo',
                            [
                                'records' => $records,
                                'sugestoes' => $sugestoes
                            ]);
                    })
                    ->stickyModalHeader()
                    ->modalHeading('Comparativo de Preços')
                    ->modalSubmitAction(false)
                    ->modalWidth('full')
            ])
            ->selectCurrentPageOnly();
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
//            'create' => Pages\CreateConformidade::route('/create'),
//            'edit' => Pages\EditConformidade::route('/{record}/edit'),
            'view' => Pages\ViewConformidade::route('/{record}'),
        ];
    }

    public function teste()
    {
        dd('oi');
    }
}
