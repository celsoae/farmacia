<?php

namespace App\Filament\Resources\ConformidadeResource\Pages;

use App\Filament\Resources\ConformidadeResource;
use Filament\Actions;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Alignment;

class ViewConformidade extends ViewRecord
{
    protected static string $resource = ConformidadeResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informações Basicas')
                    ->description('Informações gerais do medicamento.')
                    ->schema([
                        TextEntry::make('SUBSTANCIA')
                            ->label('Substância')
                            ->columnSpan(1),
                        TextEntry::make('LABORATORIO')
                            ->label('Laboratorio')
                            ->columnSpan(2),
                        TextEntry::make('CNPJ')
                            ->label('CNPJ')
                            ->columnSpan(1),
                        TextEntry::make('TIPO_PRODUTO')
                            ->label('Tipo')
                            ->columnSpan(1),
                        TextEntry::make('PRODUTO')
                            ->label('Produto')
                            ->columnSpan(2),
                        TextEntry::make('TARJA')
                            ->label('Tarja')
                            ->badge()
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'Tarja Vermelha' => 'Vermelha',
                                'Tarja Vermelha sob restrição' => 'Vermelha Restrita',
                                'Tarja Preta' => 'Preta',
                                'Tarja Sem Tarja', '- (*)' => 'Sem tarja',
                            })
                            ->color(fn(string $state): string => match ($state) {
                                'Tarja Vermelha', 'Tarja Vermelha sob restrição' => 'danger',
                                'Tarja Preta' => 'gray',
                                'Tarja Sem Tarja', '- (*)' => 'gray',
                            }),
//                        IconEntry::make('TARJA')
//                            ->label('Tarja')
//                            ->icon(fn(string $state): string => match ($state) {
//                                'Tarja Vermelha' => 'heroicon-s-rectangle-stack',
//                                'Tarja Vermelha sob restrição' => 'heroicon-s-rectangle-stack',
//                                'Tarja Preta' => 'heroicon-s-rectangle-stack',
//                                'Tarja Sem Tarja' => 'heroicon-o-minus-circle',
//                                '- (*)' => 'heroicon-o-minus-circle',
//                            })
//                            ->color(fn(string $state): string => match ($state) {
//                                'Tarja Vermelha' => 'danger',
//                                'Tarja Vermelha sob restrição' => 'danger',
//                                'Tarja Preta' => 'black',
//                                'Tarja Sem Tarja' => 'gray',
//                                '- (*)' => 'gray',
//                            }),
                        TextEntry::make('CLASSE_TERAPEUTICA')
                            ->label('Classe Terapeutica')
                            ->columnSpan(1),
                        TextEntry::make('APRESENTACAO')
                            ->label('Apresentação')
                            ->columnSpan(3),
                    ])
                    ->columns(4)
//                    ->collapsible()
                    ->columnSpan(3),
                Section::make('Valores')
                    ->description('Lista de convênos atendidos com seus valores, baseados na lista de alícota.')
                    ->schema([
                        Section::make()
                            ->schema([
                                ImageEntry::make('logo')
                                    ->hiddenLabel()
                                    ->defaultImageUrl(asset('assets/img/logos/unimed.png'))
                                    ->width(25)
                                    ->height(25)
                                    ->circular()
                                    ->alignCenter(),
                                TextEntry::make('convenio')
                                    ->label('Unimed')
                                    ->alignStart(),
                                TextEntry::make('PF_17')
                                    ->hiddenLabel()
                                    ->alignCenter()
                                    ->formatStateUsing(function (string $state) {
                                        return number_format($state, 2, ',', '.');
                                    }),
                            ])
                            ->columns(3),
                        Section::make()
                            ->schema([
                                ImageEntry::make('logo')
                                    ->hiddenLabel()
                                    ->defaultImageUrl(asset('assets/img/logos/bradesco.jpg'))
                                    ->width(25)
                                    ->height(25)
                                    ->circular()
                                    ->alignCenter(),
                                TextEntry::make('convenio')
                                    ->label('Bradesco')
                                    ->alignStart(),
                                TextEntry::make('PF_17')
                                    ->hiddenLabel()
                                    ->alignCenter()
                                    ->formatStateUsing(function (string $state) {
                                        return number_format($state, 2, ',', '.');
                                    }),
                            ])
                            ->columns(3),
                        Section::make()
                            ->schema([
                                ImageEntry::make('logo')
                                    ->hiddenLabel()
                                    ->defaultImageUrl(asset('assets/img/logos/hapivida.png'))
                                    ->width(25)
                                    ->height(25)
                                    ->circular()
                                    ->alignCenter(),
                                TextEntry::make('convenio')
                                    ->label('Hapvida')
                                    ->alignStart(),
                                TextEntry::make('PF_17')
                                    ->hiddenLabel()
                                    ->alignCenter()
                                    ->formatStateUsing(function (string $state) {
                                        return number_format($state, 2, ',', '.');
                                    }),
                            ])
                            ->columns(3),
                        Section::make()
                            ->schema([
                                ImageEntry::make('logo')
                                    ->hiddenLabel()
                                    ->defaultImageUrl(asset('assets/img/logos/unimed.png'))
                                    ->width(25)
                                    ->height(25)
                                    ->circular()
                                    ->alignCenter(),
                                TextEntry::make('convenio')
                                    ->label('Unimed')
                                    ->alignStart(),
                                TextEntry::make('PF_17')
                                    ->hiddenLabel()
                                    ->alignCenter()
                                    ->formatStateUsing(function (string $state) {
                                        return number_format($state, 2, ',', '.');
                                    }),
                            ])
                            ->columns(3),
                    ])
                    ->columns(1)
                    ->columnSpan(1)
            ])
            ->columns(4);
    }
}
