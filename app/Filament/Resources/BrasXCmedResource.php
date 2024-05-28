<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrasXCmedResource\Pages;
use App\Filament\Resources\BrasXCmedResource\RelationManagers;
use App\Models\BrasXCmed;
use App\Models\Cmed;
use App\Models\FormasFarmaceuticas;
use Doctrine\DBAL\Driver\OCI8\Exception\Error;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\Closure;
use PHPUnit\Util\Filter;

class BrasXCmedResource extends Resource
{
    protected static ?string $model = BrasXCmed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public $test;

    public static function table(Table $table): Table
    {
        $test = $table->getFilters();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registro_anvisa'),
                Tables\Columns\TextColumn::make('apresenta')
                    ->state(function ($record) {
//                        dd($record->farma->getAttribute('id'));
                        $state = $record->cmed->PRODUTO . ' - ' . $record->cmed->APRESENTA__O;
                        return $state;
                    })
                    ->searchable()
                    ->label('CMED.Apresentação'),
                Tables\Columns\TextColumn::make('cmed.embalagem')
                    ->label('CMED.Embalagem'),
                Tables\Columns\TextColumn::make('viaAdministracao')
                    ->state(function ($record) {
                        $state = $record->cmed->viasAdministracao?->getAttribute('descricao');
                        return $state;
                    })
                    ->label('VIAS.Descricao'),
                Tables\Columns\TextColumn::make('forma_farmaceutica')
                    ->state(function ($record) {
                        $state = $record->cmed->formaFarmaceutica?->getAttribute('descricao');
                        return $state;
                    })
                    ->label('FORMA_FARMA'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Forma Farmaceutica')
                    ->relationship('cmed.formaFarmaceutica', 'descricao'),
                Tables\Filters\SelectFilter::make('produtos')
                    ->searchable()
                    ->getSearchResultsUsing(function ($search) {
                        return Cmed::where('PRODUTO', 'like', '%' . $search . '%')
                            ->limit(10)->pluck('PRODUTO', 'PRODUTO')
                            ->unique()->toArray();
                    })
                    ->query(function (Builder $query, array $data, Forms\Get $get) {
                        return $query->whereHas('cmed', function ($query) use ($data, $get) {
                                $query->where('PRODUTO', 'like', '%' . $data['value'] . '%');
                        });
                    }),
                Tables\Filters\Filter::make('volume')
                    ->label('Volume')
                    ->hidden(function (Tables\Contracts\HasTable $livewire) {
                        if ($livewire->tableFilters) {
                            if ($livewire->tableFilters['produtos']['value'] == null) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                        return true;
                    })
                    ->form([
                        Forms\Components\TextInput::make('volume')
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->whereHas('cmed', function ($query) use ($data) {
                            if (in_array('volume', $data))
                                $query->where('APRESENTA__O', 'like', '%' . $data['volume'] . '%');
                        });
                    }),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
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
            'index' => Pages\ListBrasXCmeds::route('/'),
            'create' => Pages\CreateBrasXCmed::route('/create'),
            'edit' => Pages\EditBrasXCmed::route('/{record}/edit'),
        ];
    }
}
