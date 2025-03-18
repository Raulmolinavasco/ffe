<?php

namespace App\Filament\Resources\AcuerdoResource\Pages;

use App\Filament\Resources\AcuerdoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcuerdos extends ListRecords
{
    protected static string $resource = AcuerdoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
