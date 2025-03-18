<?php

namespace App\Filament\Resources\RaResource\Pages;

use App\Filament\Resources\RaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRa extends CreateRecord
{
    protected static string $resource = RaResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
