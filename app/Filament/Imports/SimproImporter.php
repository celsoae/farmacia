<?php

namespace App\Filament\Imports;

use App\Models\Simpro;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\TextInput;

class SimproImporter extends Importer
{
    protected static ?string $model = Simpro::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('codigoUsuario')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('codigoFracao')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('descricao')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('vigencia')
                ->requiredMapping()
                ->castStateUsing(function (string $state): ?string {
                    return $state ? Carbon::createFromFormat('dmY', $state)->format('Y-m-d') : null;
                })
                ->rules(['required', 'date']),
            ImportColumn::make('identificacao')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('precoFabrica')
                ->castStateUsing(function (string $state): ?string {
                    return $state ? floatval($state) / 100 : '0.00';
                })
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('precoVenda')
                ->castStateUsing(function (string $state): ?string {
                    return $state ? floatval($state) / 100 : '0.00';
                })
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('precoUsuario')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('precoFabricaFracao')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('precoVendaFracao')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('precoUsuarioFracao')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('embalagem')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('fracao')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('quantidadeEmbalagem')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('quantidadeFracao')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('lucro')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('tipoAlteracao')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('fabricante')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('codigoSimpro')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('codigoMercado')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('desconto')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('ipi')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('anvisa')
                ->requiredMapping()
                ->numeric()
                ->rules(['max:255']),
            ImportColumn::make('validadeAnvisa')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('codigoEAN')
                ->label('Codigo EAN')
                ->castStateUsing(function ($state) {
                    return $state ?: null;
                })
                ->numeric()
                ->requiredMapping(),
            ImportColumn::make('lista')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('hospitalar')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('fracionavel')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('codigoTUSS')
                ->label('Codigo TUSS')
                ->requiredMapping()
                ->numeric(),
            ImportColumn::make('classificacao')
                ->rules(['max:255']),
            ImportColumn::make('referencia')
                ->rules(['max:255']),
            ImportColumn::make('generico')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('diversos')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Simpro
    {
        // return Simpro::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Simpro();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your simpro import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
