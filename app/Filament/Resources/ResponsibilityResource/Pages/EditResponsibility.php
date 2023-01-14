<?php

namespace App\Filament\Resources\ResponsibilityResource\Pages;

use App\Filament\Resources\ResponsibilityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResponsibility extends EditRecord
{
    protected static string $resource = ResponsibilityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
