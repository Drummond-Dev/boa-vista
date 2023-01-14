<?php

namespace App\Filament\Resources\NewspaperResource\Pages;

use App\Filament\Resources\NewspaperResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewspapers extends ListRecords
{
    protected static string $resource = NewspaperResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
