<?php

namespace App\Filament\Resources\ConformidadeResource\Pages;

use App\Filament\Resources\ConformidadeResource;
use Doctrine\DBAL\Schema\Column;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListConformidades extends ListRecords
{
    protected static string $resource = ConformidadeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
