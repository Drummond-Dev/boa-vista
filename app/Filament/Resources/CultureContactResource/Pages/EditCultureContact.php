<?php

namespace App\Filament\Resources\CultureContactResource\Pages;

use App\Filament\Resources\CultureContactResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCultureContact extends EditRecord
{
    protected static string $resource = CultureContactResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
