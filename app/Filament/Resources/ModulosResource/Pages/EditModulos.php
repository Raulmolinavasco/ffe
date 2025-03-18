<?php

namespace App\Filament\Resources\ModulosResource\Pages;

use App\Filament\Resources\ModulosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModulos extends EditRecord
{
    protected static string $resource = ModulosResource::class;

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
