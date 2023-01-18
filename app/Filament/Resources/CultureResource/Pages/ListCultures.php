<?php

namespace App\Filament\Resources\CultureResource\Pages;

use App\Filament\Resources\CultureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCultures extends ListRecords
{
    protected static string $resource = CultureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
