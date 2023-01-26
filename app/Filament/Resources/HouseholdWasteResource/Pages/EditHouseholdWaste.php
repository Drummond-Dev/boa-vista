<?php

namespace App\Filament\Resources\HouseholdWasteResource\Pages;

use App\Filament\Resources\HouseholdWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHouseholdWaste extends EditRecord
{
    protected static string $resource = HouseholdWasteResource::class;

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
