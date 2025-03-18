<?php

namespace App\Filament\Resources\AcuerdoResource\Pages;

use App\Filament\Resources\AcuerdoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAcuerdo extends CreateRecord
{
    protected static string $resource = AcuerdoResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
