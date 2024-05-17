<?php

namespace App\Filament\Imports;

use App\Models\Tuss24;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\TextInput;

class Tuss24Importer extends Importer
{
    protected static ?string $model = Tuss24::class;

//    public static function getOptionsFormComponents(): array
//    {
//        return [
//            TextInput::make('observacao'),
//        ];
//    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping(),
            ImportColumn::make('display')
                ->requiredMapping(),
        ];
    }

    public function resolveRecord(): ?Tuss24
    {
//        $observacao = $this->getOptions()['Adicionais']['observacao'];
//
//        $tuss24 = new Tuss24();
//        $tuss24->setAttribute('observacao', $observacao);
//
//        return $tuss24;
        // return Tuss24::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Tuss24();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your tuss24 import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
