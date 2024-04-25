<?php

namespace App\Filament\Imports;

use App\Models\Conformidade;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ConformidadeImporter extends Importer
{
    protected static ?string $model = Conformidade::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('SUBSTANCIA')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('CNPJ')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('LABORATORIO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('CODIGO_GGREM')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('REGISTRO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('EAN_1')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('EAN_2')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('EAN_3')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('PRODUTO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('APRESENTACAO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('CLASSE_TERAPEUTICA')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('TIPO_PRODUTO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('REGIME_DE_PRECO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('PF_SEM_IMPOSTOS')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_0')
                ->label('PF 0%')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_12')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_12_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_17')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_17_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_17-5')
                ->guess(['PF_17-5', 'P f 17 5'])
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_17-5_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_18')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_18_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_19')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_19_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_19-5')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_19-5_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_20')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_20_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_20-5')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_21')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_21_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_22')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PF_22_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_SEM_IMPOSTO')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_0')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_12')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_12_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_17')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_17_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_17-5')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_17-5_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_18')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_18_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_19')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_19_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_19-5')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_19-5_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_20')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_20_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_20-5')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_21')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_21_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_22')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('PMC_22_ALC')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('RESTRICAO_HOSPITALAR')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('CAP')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('CONFAZ_87')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('ICMS_0')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('ANALISE_RECURSAL')
                ->requiredMapping()
                ->rules(['max:255']),
            ImportColumn::make('LISTA_CONCESSAO')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('COMERCIALIZACAO_2022')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('TARJA')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Conformidade
    {
        // return Conformidade::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Conformidade();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your conformidade import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
