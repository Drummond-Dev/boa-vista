<?php

namespace App\Filament\Resources\ResponsibilityResource\Pages;

use App\Filament\Resources\ResponsibilityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResponsibility extends CreateRecord
{
    protected static string $resource = ResponsibilityResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
