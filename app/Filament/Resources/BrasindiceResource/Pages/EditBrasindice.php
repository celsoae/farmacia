<?php

namespace App\Filament\Resources\BrasindiceResource\Pages;

use App\Filament\Resources\BrasindiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrasindice extends EditRecord
{
    protected static string $resource = BrasindiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
