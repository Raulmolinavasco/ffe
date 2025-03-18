<?php

namespace App\Filament\Resources\CentroEducativoResource\Pages;

use App\Filament\Resources\CentroEducativoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCentroEducativo extends EditRecord
{
    protected static string $resource = CentroEducativoResource::class;

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
