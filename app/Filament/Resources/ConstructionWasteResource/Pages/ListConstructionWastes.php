<?php

namespace App\Filament\Resources\ConstructionWasteResource\Pages;

use App\Filament\Resources\ConstructionWasteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConstructionWastes extends ListRecords
{
    protected static string $resource = ConstructionWasteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
