<?php

namespace App\Filament\Resources\LegislationResource\Pages;

use App\Filament\Resources\LegislationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegislations extends ListRecords
{
    protected static string $resource = LegislationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
