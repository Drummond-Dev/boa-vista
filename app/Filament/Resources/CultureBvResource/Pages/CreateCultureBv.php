<?php

namespace App\Filament\Resources\CultureBvResource\Pages;

use App\Filament\Resources\CultureBvResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCultureBv extends CreateRecord
{
    protected static string $resource = CultureBvResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
