<?php

namespace App\Filament\Resources\Testies\Pages;

use App\Filament\Resources\Testies\TestyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTesty extends ViewRecord
{
    protected static string $resource = TestyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
