<?php

namespace App\Filament\Resources\CentroEducativoResource\Pages;

use App\Filament\Resources\CentroEducativoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCentroEducativos extends ListRecords
{
    protected static string $resource = CentroEducativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
