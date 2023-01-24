<?php

namespace App\Filament\Resources\CultureContactResource\Pages;

use App\Filament\Resources\CultureContactResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCultureContact extends CreateRecord
{
    protected static string $resource = CultureContactResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
