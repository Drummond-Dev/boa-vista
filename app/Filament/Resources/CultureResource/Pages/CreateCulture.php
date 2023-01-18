<?php

namespace App\Filament\Resources\CultureResource\Pages;

use App\Filament\Resources\CultureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCulture extends CreateRecord
{
    protected static string $resource = CultureResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
