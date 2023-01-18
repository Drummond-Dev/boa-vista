<?php

namespace App\Filament\Resources\CultureBvResource\Pages;

use App\Filament\Resources\CultureBvResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCultureBvs extends ListRecords
{
    protected static string $resource = CultureBvResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
