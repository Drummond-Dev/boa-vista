<?php

namespace App\Filament\Resources\WasteManagementResource\Pages;

use App\Filament\Resources\WasteManagementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteManagement extends EditRecord
{
    protected static string $resource = WasteManagementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
