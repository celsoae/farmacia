<?php

namespace App\Filament\Resources\BrasXCmedResource\Pages;

use App\Filament\Resources\BrasXCmedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrasXCmed extends EditRecord
{
    protected static string $resource = BrasXCmedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
