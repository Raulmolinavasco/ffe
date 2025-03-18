<?php

namespace App\Filament\Resources\ModulosResource\Pages;

use App\Filament\Resources\ModulosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModulos extends ListRecords
{
    protected static string $resource = ModulosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
