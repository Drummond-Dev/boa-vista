<?php

namespace App\Filament\Resources\ResponsibilityResource\Pages;

use App\Filament\Resources\ResponsibilityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResponsibilities extends ListRecords
{
    protected static string $resource = ResponsibilityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
