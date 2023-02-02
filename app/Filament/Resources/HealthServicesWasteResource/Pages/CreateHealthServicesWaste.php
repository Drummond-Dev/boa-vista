<?php

namespace App\Filament\Resources\HealthServicesWasteResource\Pages;

use App\Filament\Resources\HealthServicesWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHealthServicesWaste extends CreateRecord
{
    protected static string $resource = HealthServicesWasteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
