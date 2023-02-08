<?php

namespace App\Filament\Resources\WasteManagementPlanResource\Pages;

use App\Filament\Resources\WasteManagementPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWasteManagementPlan extends EditRecord
{
    protected static string $resource = WasteManagementPlanResource::class;

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
