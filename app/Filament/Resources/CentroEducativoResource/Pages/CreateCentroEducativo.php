<?php

namespace App\Filament\Resources\CentroEducativoResource\Pages;

use App\Filament\Resources\CentroEducativoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCentroEducativo extends CreateRecord
{
    protected static string $resource = CentroEducativoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
