<?php

namespace App\Filament\Resources\HealthServicesWasteResource\Pages;

use App\Filament\Resources\HealthServicesWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHealthServicesWaste extends EditRecord
{
    protected static string $resource = HealthServicesWasteResource::class;

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
