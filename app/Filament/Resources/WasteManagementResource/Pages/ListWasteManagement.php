<?php

namespace App\Filament\Resources\WasteManagementResource\Pages;

use App\Filament\Resources\WasteManagementResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasteManagement extends ListRecords
{
    protected static string $resource = WasteManagementResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
