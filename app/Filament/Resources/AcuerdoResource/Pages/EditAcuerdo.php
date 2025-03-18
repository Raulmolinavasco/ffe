<?php

namespace App\Filament\Resources\AcuerdoResource\Pages;

use App\Filament\Resources\AcuerdoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcuerdo extends EditRecord
{
    protected static string $resource = AcuerdoResource::class;

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
