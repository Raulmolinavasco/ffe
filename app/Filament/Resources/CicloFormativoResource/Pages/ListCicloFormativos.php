<?php

namespace App\Filament\Resources\CicloFormativoResource\Pages;

use App\Filament\Resources\CicloFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCicloFormativos extends ListRecords
{
    protected static string $resource = CicloFormativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
