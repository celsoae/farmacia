<?php

namespace App\Filament\Resources\BrasXCmedResource\Pages;

use App\Filament\Resources\BrasXCmedResource;
use App\Models\BrasXCmed;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrasXCmeds extends ListRecords
{
    protected static string $resource = BrasXCmedResource::class;

    public function rendered()
    {
        $this->js("
           document.getElementById('tableFilters.volume.volume').addEventListener('input', function(e) {
                let term = e.target.value;
                term = term.replace(/[^0-9,]/g, '');
                e.target.value = term;
           })
        ");
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
