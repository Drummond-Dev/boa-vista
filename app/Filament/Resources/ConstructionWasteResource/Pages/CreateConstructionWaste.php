<?php

namespace App\Filament\Resources\ConstructionWasteResource\Pages;

use App\Filament\Resources\ConstructionWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConstructionWaste extends CreateRecord
{
    protected static string $resource = ConstructionWasteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
