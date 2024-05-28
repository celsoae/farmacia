<?php

namespace App\Filament\Resources\Brasindice\OncologicosResource\Pages;

use App\Filament\Resources\Brasindice\OncologicosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOncologicos extends EditRecord
{
    protected static string $resource = OncologicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
