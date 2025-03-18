<?php

namespace App\Filament\Resources\CicloFormativoResource\Pages;

use App\Filament\Resources\CicloFormativoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCicloFormativo extends EditRecord
{
    protected static string $resource = CicloFormativoResource::class;

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
