<?php

namespace App\Filament\Resources\Buzzers\Pages;

use App\Filament\Resources\Buzzers\BuzzerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBuzzers extends ListRecords
{
    protected static string $resource = BuzzerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
