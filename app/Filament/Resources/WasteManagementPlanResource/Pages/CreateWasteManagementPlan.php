<?php

namespace App\Filament\Resources\WasteManagementPlanResource\Pages;

use App\Filament\Resources\WasteManagementPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWasteManagementPlan extends CreateRecord
{
    protected static string $resource = WasteManagementPlanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
