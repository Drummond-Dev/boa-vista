<?php

namespace App\Filament\Resources\ConstructionWasteResource\Pages;

use App\Filament\Resources\ConstructionWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConstructionWaste extends EditRecord
{
    protected static string $resource = ConstructionWasteResource::class;

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
