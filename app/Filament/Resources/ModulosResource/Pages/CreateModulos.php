<?php

namespace App\Filament\Resources\ModulosResource\Pages;

use App\Filament\Resources\ModulosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModulos extends CreateRecord
{
    protected static string $resource = ModulosResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
