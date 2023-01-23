<?php

namespace App\Filament\Resources\AccreditationBandsResource\Pages;

use App\Filament\Resources\AccreditationBandsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccreditationBands extends EditRecord
{
    protected static string $resource = AccreditationBandsResource::class;

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
