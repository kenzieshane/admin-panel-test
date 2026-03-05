<?php

namespace App\Filament\Resources\Testies;

use App\Filament\Resources\Testies\Pages\CreateTesty;
use App\Filament\Resources\Testies\Pages\EditTesty;
use App\Filament\Resources\Testies\Pages\ListTesties;
use App\Filament\Resources\Testies\Pages\ViewTesty;
use App\Filament\Resources\Testies\Schemas\TestyForm;
use App\Filament\Resources\Testies\Schemas\TestyInfolist;
use App\Filament\Resources\Testies\Tables\TestiesTable;
use App\Models\Testy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestyResource extends Resource
{
    protected static ?string $model = Effort::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-heart';


    protected static ?string $recordTitleAttribute = 'idk';
        protected static ?string $navigationLabel = 'Rancangan Memajukan Bangsa';

    public static function form(Schema $schema): Schema
    {
        return TestyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TestyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestiesTable::configure($table);
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
            'index' => ListTesties::route('/'),
            'create' => CreateTesty::route('/create'),
            'view' => ViewTesty::route('/{record}'),
            'edit' => EditTesty::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
