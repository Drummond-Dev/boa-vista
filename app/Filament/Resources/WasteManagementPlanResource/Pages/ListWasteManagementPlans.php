<?php

namespace App\Filament\Resources\WasteManagementPlanResource\Pages;

use App\Filament\Resources\WasteManagementPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWasteManagementPlans extends ListRecords
{
    protected static string $resource = WasteManagementPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
