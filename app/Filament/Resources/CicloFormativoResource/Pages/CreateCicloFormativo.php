<?php

namespace App\Filament\Resources\CicloFormativoResource\Pages;

use App\Filament\Resources\CicloFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCicloFormativo extends CreateRecord
{
    protected static string $resource = CicloFormativoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
