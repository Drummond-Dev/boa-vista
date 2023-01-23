<?php

namespace App\Filament\Resources\LawResource\Pages;

use App\Filament\Resources\LawResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaw extends EditRecord
{
    protected static string $resource = LawResource::class;

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
