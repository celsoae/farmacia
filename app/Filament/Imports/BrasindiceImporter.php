<?php

namespace App\Filament\Imports;

use App\Models\Brasindice;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\TextInput;

class BrasindiceImporter extends Importer
{
    protected static ?string $model = Brasindice::class;

    public static function getOptionsFormComponents(): array
    {
        return [
            TextInput::make('aliquota')
                ->label('Aliquota Importada')
                ->required()
        ];
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('cod_laboratorio')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('nome_laboratorio')
                ->rules(['max:255']),
            ImportColumn::make('codigo_item')
                ->rules(['max:255']),
            ImportColumn::make('nome_item')
                ->rules(['max:255']),
            ImportColumn::make('codigo_apresentacao')
                ->rules(['max:255']),
            ImportColumn::make('nome_apresentacao')
                ->rules(['max:255']),
            ImportColumn::make('preco_item')
                ->rules(['max:255']),
            ImportColumn::make('qt_para_fracionamento')
                ->rules(['max:255']),
            ImportColumn::make('tipo_preco')
                ->rules(['max:255']),
            ImportColumn::make('preco_item_fracionado')
                ->rules(['max:255']),
            ImportColumn::make('edicao_ultima_alteracao')
                ->rules(['max:255']),
            ImportColumn::make('ipi')
                ->rules(['max:255']),
            ImportColumn::make('flag_pis_cofins')
                ->rules(['max:255']),
            ImportColumn::make('codigo_ean')
                ->rules(['max:255']),
            ImportColumn::make('codigo_tiss_brasindice')
                ->rules(['max:255']),
            ImportColumn::make('codigo_tuss')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Brasindice
    {
        $aliquota = $this->getOptions()['adicionais']['aliquota'];

        $brasindice = new Brasindice();
        $brasindice->setAttribute('aliquota', $aliquota);

        return $brasindice;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your brasindice import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
