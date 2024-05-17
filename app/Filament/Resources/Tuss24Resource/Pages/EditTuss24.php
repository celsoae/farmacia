<?php

namespace App\Filament\Resources\Tuss24Resource\Pages;

use App\Filament\Resources\Tuss24Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTuss24 extends EditRecord
{
    protected static string $resource = Tuss24Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
