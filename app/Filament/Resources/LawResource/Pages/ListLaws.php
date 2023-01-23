<?php

namespace App\Filament\Resources\LawResource\Pages;

use App\Filament\Resources\LawResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaws extends ListRecords
{
    protected static string $resource = LawResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
