<?php

namespace App\Filament\Resources\Buzzers;

use App\Filament\Resources\Buzzers\Pages\CreateBuzzer;
use App\Filament\Resources\Buzzers\Pages\EditBuzzer;
use App\Filament\Resources\Buzzers\Pages\ListBuzzers;
use App\Filament\Resources\Buzzers\Pages\ViewBuzzer;
use App\Filament\Resources\Buzzers\Schemas\BuzzerForm;
use App\Filament\Resources\Buzzers\Schemas\BuzzerInfolist;
use App\Filament\Resources\Buzzers\Tables\BuzzersTable;
use App\Models\Buzzer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BuzzerResource extends Resource
{

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
protected static string | \UnitEnum | null $navigationGroup = 'anggota partai';
    protected static ?string $recordTitleAttribute = 'ofcidk';

    public static function form(Schema $schema): Schema
    {
        return BuzzerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BuzzerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BuzzersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBuzzers::route('/'),
            'create' => CreateBuzzer::route('/create'),
            'view' => ViewBuzzer::route('/{record}'),
            'edit' => EditBuzzer::route('/{record}/edit'),
        ];
    }
}
