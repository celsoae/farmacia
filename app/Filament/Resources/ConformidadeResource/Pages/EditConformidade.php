<?php

namespace App\Filament\Resources\ConformidadeResource\Pages;

use App\Filament\Resources\ConformidadeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConformidade extends EditRecord
{
    protected static string $resource = ConformidadeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
