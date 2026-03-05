<?php

namespace App\Filament\Resources\Buzzers\Pages;

use App\Filament\Resources\Buzzers\BuzzerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBuzzer extends EditRecord
{
    protected static string $resource = BuzzerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
