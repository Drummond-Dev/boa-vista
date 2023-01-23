<?php

namespace App\Filament\Resources\LawResource\Pages;

use App\Filament\Resources\LawResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaw extends CreateRecord
{
    protected static string $resource = LawResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
