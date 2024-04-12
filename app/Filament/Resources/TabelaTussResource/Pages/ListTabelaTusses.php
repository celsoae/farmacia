<?php

namespace App\Filament\Resources\TabelaTussResource\Pages;

use App\Filament\Resources\TabelaTussResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTabelaTusses extends ListRecords
{
    protected static string $resource = TabelaTussResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
