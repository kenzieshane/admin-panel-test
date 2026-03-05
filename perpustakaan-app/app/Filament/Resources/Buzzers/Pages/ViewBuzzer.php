<?php

namespace App\Filament\Resources\Buzzers\Pages;

use App\Filament\Resources\Buzzers\BuzzerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBuzzer extends ViewRecord
{
    protected static string $resource = BuzzerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
