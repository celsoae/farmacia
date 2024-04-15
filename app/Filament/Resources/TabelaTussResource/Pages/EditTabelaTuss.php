<?php

namespace App\Filament\Resources\TabelaTussResource\Pages;

use App\Filament\Resources\TabelaTussResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTabelaTuss extends EditRecord
{
    protected static string $resource = TabelaTussResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
