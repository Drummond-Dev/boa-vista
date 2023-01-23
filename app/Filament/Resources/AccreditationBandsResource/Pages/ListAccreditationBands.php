<?php

namespace App\Filament\Resources\AccreditationBandsResource\Pages;

use App\Filament\Resources\AccreditationBandsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccreditationBands extends ListRecords
{
    protected static string $resource = AccreditationBandsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
