<?php

namespace App\Filament\Resources\HouseholdWasteResource\Pages;

use App\Filament\Resources\HouseholdWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHouseholdWaste extends CreateRecord
{
    protected static string $resource = HouseholdWasteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
