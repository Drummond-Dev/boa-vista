<?php

namespace App\Filament\Resources\CultureBvResource\Pages;

use App\Filament\Resources\CultureBvResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCultureBv extends EditRecord
{
    protected static string $resource = CultureBvResource::class;

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
