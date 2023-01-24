<?php

namespace App\Filament\Resources\CultureContactResource\Pages;

use App\Filament\Resources\CultureContactResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCultureContacts extends ListRecords
{
    protected static string $resource = CultureContactResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
