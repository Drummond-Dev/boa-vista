<?php

namespace App\Filament\Resources\AccreditationResource\Pages;

use App\Filament\Resources\AccreditationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccreditations extends ListRecords
{
    protected static string $resource = AccreditationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
