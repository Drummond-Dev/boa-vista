<?php

namespace App\Filament\Resources\HouseholdWasteResource\Pages;

use App\Filament\Resources\HouseholdWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHouseholdWastes extends ListRecords
{
    protected static string $resource = HouseholdWasteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
