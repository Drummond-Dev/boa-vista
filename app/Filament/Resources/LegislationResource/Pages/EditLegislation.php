<?php

namespace App\Filament\Resources\LegislationResource\Pages;

use App\Filament\Resources\LegislationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLegislation extends EditRecord
{
    protected static string $resource = LegislationResource::class;

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
