<?php

namespace App\Filament\Resources\LegislationResource\Pages;

use App\Filament\Resources\LegislationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLegislation extends CreateRecord
{
    protected static string $resource = LegislationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
