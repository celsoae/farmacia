<?php

namespace App\Filament\Imports;

use App\Models\Simpro;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SimproImporter extends Importer
{
    protected static ?string $model = Simpro::class;

    public static function getOptionsFormComponents(): array
    {
        return [
            TextInput::make('versao')
                ->label('Versão da importação')
                ->required()
        ];
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('codigoUsuario')
                ->guess(['CD_USUARIO'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('codigoFracao')
                ->guess(['CD_FRACAO'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('descricao')
                ->guess(['DESCRICAO'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('vigencia')
                ->requiredMapping()
                ->castStateUsing(function (string $state): ?string {
                    return $state ? Carbon::createFromFormat('dmY', $state)->format('Y-m-d') : null;
                })
                ->rules(['date']),
            ImportColumn::make('identificacao')
                ->guess(['IDENTIF'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('precoFabrica')
                ->guess(['PC_EM_FAB'])
                ->castStateUsing(function (string $state): ?string {
                    return $state ? floatval($state) / 100 : '0.00';
                })
                ->requiredMapping(),
            ImportColumn::make('precoVenda')
                ->guess(['PC_EM_VEN'])
                ->castStateUsing(function (string $state): ?string {
                    return $state ? floatval($state) / 100 : '0.00';
                })
                ->requiredMapping(),
            ImportColumn::make('precoUsuario')
                ->guess(['PC_EM_USU'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('precoFabricaFracao')
                ->guess(['PC_FR_FAB'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('precoVendaFracao')
                ->guess(['PC_FR_VEN'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('precoUsuarioFracao')
                ->guess(['PC_FR_USU'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('embalagem')
                ->guess(['TP_EMBAL'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('fracao')
                ->guess(['TP_FRACAO'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('quantidadeEmbalagem')
                ->guess(['QTDE_EMBAL'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('quantidadeFracao')
                ->guess(['QTDE_FRAC'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('lucro')
                ->guess(['PERC_LUCR'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tipoAlteracao')
                ->guess(['TIP_ALT'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('fabricante')
                ->guess(['FABRICA'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('codigoSimpro')
                ->guess(['CD_SIMPRO'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('codigoMercado')
                ->guess(['CD_MERCADO'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('desconto')
                ->guess(['PERC_DESC'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('ipi')
                ->guess(['IPI_PRODUTO'])
                ->requiredMapping()
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('anvisa')
                ->guess(['REGISTRO_ANVISA'])
                ->requiredMapping()
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('validadeAnvisa')
                ->guess(['VALIDADE_ANVISA'])
                ->requiredMapping(),
            ImportColumn::make('codigoEAN')
                ->label('Codigo EAN')
                ->guess(['CD_BARRA'])
                ->requiredMapping()
                ->rules(['nullable']),
            ImportColumn::make('lista')
                ->guess(['LISTA'])
                ->requiredMapping()
                ->rules(['nullable', 'max:255']),
            ImportColumn::make('hospitalar')
                ->guess(['HOSPITALAR'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('fracionavel')
                ->guess(['FRACIONAR'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('codigo_tuss')
                ->label('Codigo TUSS')
                ->guess(['CD_TUSS'])
                ->requiredMapping()
                ->numeric()
                ->rules(['nullable']),
            ImportColumn::make('classificacao')
                ->guess(['CD_CLASSIF'])
                ->rules(['max:255']),
            ImportColumn::make('referencia')
                ->guess(['CD_REF_PRO'])
                ->rules(['max:255']),
            ImportColumn::make('generico')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('diversos')
                ->requiredMapping()
                ->rules(['max:255']),
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
