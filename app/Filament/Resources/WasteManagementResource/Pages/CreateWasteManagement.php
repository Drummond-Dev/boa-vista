<?php

namespace App\Filament\Resources\WasteManagementResource\Pages;

use App\Filament\Resources\WasteManagementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWasteManagement extends CreateRecord
{
    protected static string $resource = WasteManagementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
