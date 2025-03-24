<?php

namespace App\Filament\Resources\PlanFormativoResource\Pages;

use App\Filament\Resources\PlanFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlanFormativos extends ListRecords
{
    protected static string $resource = PlanFormativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
