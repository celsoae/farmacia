<?php

namespace App\Filament\Resources\BrasindiceResource\Pages;

use App\Filament\Resources\BrasindiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListBrasindices extends ListRecords
{
    protected static string $resource = BrasindiceResource::class;

//    protected function getActions(): array
//    {
//        return [
//            ImportAction::make()
//                ->fields([
//                    ImportField::make('cod_laboratorio')
//                        ->label('Código do Laboratório'),
//                    ImportField::make('nome_laboratorio')
//                ])
//        ];
//    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('cod_laboratorio')
                        ->label('Código do Laboratório'),
                    ImportField::make('nome_laboratorio'),
                    ImportField::make('codigo_item'),
                    ImportField::make('nome_item'),
                    ImportField::make('codigo_apresentacao'),
                    ImportField::make('nome_apresentacao'),
                    ImportField::make('preco_item'),
                    ImportField::make('qt_para_fracionamento'),
                    ImportField::make('tipo_preco'),
                    ImportField::make('preco_item_fracionado'),
                    ImportField::make('edicao_ultima_alteracao'),
                    ImportField::make('ipi'),
                    ImportField::make('flag_pis_cofins'),
                    ImportField::make('codigo_ean'),
                    ImportField::make('codigo_tiss_brasindice'),
                    ImportField::make('codigo_tuss'),
                ])
        ];
    }
}
