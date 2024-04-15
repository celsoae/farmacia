<?php

namespace App\Filament\Imports;

use App\Models\TabelaTuss;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TabelaTussImporter extends Importer
{
    protected static ?string $model = TabelaTuss::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('cod_termo')
                ->requiredMapping()
                ->guess(['Código', 'Código do Termo'])
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('termo')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('apresentacao')
                ->guess(['Apresentação'])
                ->requiredMapping()
                ->rules(['required', 'max:65535']),
            ImportColumn::make('laboratorio')
                ->guess(['laboratório'])
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('data_inicio_vigencia')
                ->requiredMapping()
                ->guess(['início de vigência', 'Data de início de vigência'])
                ->castStateUsing(function (?string $state): ?string {
                    return $state ? Carbon::createFromFormat('d/m/Y', $state)->format('Y-m-d') : null;
                })
                ->rules(['required', 'date']),
            ImportColumn::make('data_fim_vigencia')
                ->requiredMapping()
                ->guess(['Data de fim de vigência'])
                ->castStateUsing(function (?string $state): ?string {
                    return $state ? Carbon::createFromFormat('d/m/Y', $state)->format('Y-m-d') : null;
                })
                ->rules(['nullable', 'date']),
            ImportColumn::make('data_fim_implantacao')
                ->requiredMapping()
                ->guess(['Data de fim de implantação'])
                ->castStateUsing(function (?string $state): ?string {
                    return $state ? Carbon::createFromFormat('d/m/Y', $state)->format('Y-m-d') : null;
                })
                ->rules(['date']),
            ImportColumn::make('reg_anvisa')
                ->requiredMapping()
                ->guess(['registro anvisa'])
                ->rules(['nullable', 'max:255']),
        ];
    }

    public function resolveRecord(): ?TabelaTuss
    {
        // return TabelaTuss::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new TabelaTuss();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your tabela tuss import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
