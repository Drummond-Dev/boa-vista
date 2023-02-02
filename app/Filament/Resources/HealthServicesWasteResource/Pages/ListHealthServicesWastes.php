<?php

namespace App\Filament\Resources\HealthServicesWasteResource\Pages;

use App\Filament\Resources\HealthServicesWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthServicesWastes extends ListRecords
{
    protected static string $resource = HealthServicesWasteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
