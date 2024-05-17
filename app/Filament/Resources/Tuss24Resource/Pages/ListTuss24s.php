<?php

namespace App\Filament\Resources\Tuss24Resource\Pages;

use App\Filament\Resources\Tuss24Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTuss24s extends ListRecords
{
    protected static string $resource = Tuss24Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
