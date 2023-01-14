<?php

namespace App\Filament\Resources\NewspaperResource\Pages;

use App\Filament\Resources\NewspaperResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewspaper extends CreateRecord
{
    protected static string $resource = NewspaperResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
