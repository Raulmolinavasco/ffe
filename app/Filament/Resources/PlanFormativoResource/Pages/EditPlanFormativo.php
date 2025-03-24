<?php

namespace App\Filament\Resources\PlanFormativoResource\Pages;

use App\Filament\Resources\PlanFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanFormativo extends EditRecord
{
    protected static string $resource = PlanFormativoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
