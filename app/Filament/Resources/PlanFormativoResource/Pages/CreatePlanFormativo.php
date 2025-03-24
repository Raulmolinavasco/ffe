<?php

namespace App\Filament\Resources\PlanFormativoResource\Pages;

use App\Filament\Resources\PlanFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlanFormativo extends CreateRecord
{
    protected static string $resource = PlanFormativoResource::class;

protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
