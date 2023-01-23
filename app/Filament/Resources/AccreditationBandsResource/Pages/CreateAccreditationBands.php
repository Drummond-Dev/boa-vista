<?php

namespace App\Filament\Resources\AccreditationBandsResource\Pages;

use App\Filament\Resources\AccreditationBandsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccreditationBands extends CreateRecord
{
    protected static string $resource = AccreditationBandsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
