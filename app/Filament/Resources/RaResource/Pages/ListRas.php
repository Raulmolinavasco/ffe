<?php

namespace App\Filament\Resources\RaResource\Pages;

use App\Filament\Resources\RaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRas extends ListRecords
{
    protected static string $resource = RaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
