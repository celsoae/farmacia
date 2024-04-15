<?php

namespace App\Filament\Resources\SimproResource\Pages;

use App\Filament\Resources\SimproResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSimpro extends EditRecord
{
    protected static string $resource = SimproResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
