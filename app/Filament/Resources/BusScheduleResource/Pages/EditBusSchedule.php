<?php

namespace App\Filament\Resources\BusScheduleResource\Pages;

use App\Filament\Resources\BusScheduleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusSchedule extends EditRecord
{
    protected static string $resource = BusScheduleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
