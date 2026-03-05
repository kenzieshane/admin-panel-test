<?php

namespace App\Filament\Resources\Testies\Pages;

use App\Filament\Resources\Testies\TestyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTesties extends ListRecords
{
    protected static string $resource = TestyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
