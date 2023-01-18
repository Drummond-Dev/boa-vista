<?php

namespace App\Filament\Resources\CultureResource\Pages;

use App\Filament\Resources\CultureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCulture extends EditRecord
{
    protected static string $resource = CultureResource::class;

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
