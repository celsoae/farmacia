<?php

namespace App\Filament\Resources\SimproResource\Pages;

use App\Filament\Resources\SimproResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListSimpros extends ListRecords
{
    protected static string $resource = SimproResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->label('Importar tabela')
                ->fields([
                    ImportField::make('codigoUsuario'),
                    ImportField::make('codigoFracao'),
                    ImportField::make('descricao'),
                    ImportField::make('vigencia'),
                    ImportField::make('identificacao'),
                    ImportField::make('precoFabrica'),
                    ImportField::make('precoVenda'),
                    ImportField::make('precoUsuario'),
                    ImportField::make('precoFabricaFracao'),
                    ImportField::make('precoVendaFracao'),
                    ImportField::make('precoUsuarioFracao'),
                    ImportField::make('embalagem'),
                    ImportField::make('fracao'),
                    ImportField::make('quantidadeEmbalagem'),
                    ImportField::make('quantidadeFracao'),
                    ImportField::make('lucro'),
                    ImportField::make('tipoAlteracao'),
                    ImportField::make('fabricante'),
                    ImportField::make('codigoSimpro'),
                    ImportField::make('codigoMercado'),
                    ImportField::make('desconto'),
                    ImportField::make('ipi'),
                    ImportField::make('anvisa'),
                    ImportField::make('validadeAnvisa'),
                    ImportField::make('codigoEAN'),
                    ImportField::make('lista'),
                    ImportField::make('hospitalar'),
                    ImportField::make('fracionavel'),
                    ImportField::make('codigoTUSS'),
                    ImportField::make('classificacao'),
                    ImportField::make('referencia'),
                    ImportField::make('generico'),
                    ImportField::make('diversos'),
                ])
        ];
    }
}
