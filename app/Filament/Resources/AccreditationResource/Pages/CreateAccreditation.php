<?php

namespace App\Filament\Resources\AccreditationResource\Pages;

use App\Filament\Resources\AccreditationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccreditation extends CreateRecord
{
    protected static string $resource = AccreditationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
