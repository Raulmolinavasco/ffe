<?php

namespace App\Filament\Resources\RaResource\Pages;

use App\Filament\Resources\RaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRa extends EditRecord
{
    protected static string $resource = RaResource::class;

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
