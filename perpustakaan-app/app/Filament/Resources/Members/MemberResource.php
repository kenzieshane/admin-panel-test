<?php
namespace App\Filament\Resources\Members;
use App\Filament\Resources\Members\Pages;
use App\Models\Member;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
class MemberResource extends Resource
{
protected static ?string $model = Member::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

protected static ?string $navigationLabel = 'pemasok dana';

    protected static string | \UnitEnum | null $navigationGroup = 'anggota partai';

protected static ?int $navigationSort = 1;

public static function form(Schema $schema): Schema
{
    return $schema
        ->schema([
            
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('photo')
                ->label('Foto')
                ->circular(),

            Tables\Columns\TextColumn::make('member_code')
                ->label('Kode Anggota')
                ->searchable()
                ->sortable()
                ->copyable()
                ->badge(),

            Tables\Columns\TextColumn::make('name')
                ->label('Nama')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable()
                ->icon('heroicon-m-envelope'),

            Tables\Columns\TextColumn::make('phone')
                ->label('Telepon')
                ->searchable(),

            Tables\Columns\TextColumn::make('membership_end')
                ->label('Berakhir')
                ->date('d M Y')
                ->sortable()
                ->color(fn ($record) => $record->membership_end < now() ? 'danger' : 'success'),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'active' => 'success',
                    'inactive' => 'gray',
                    'suspended' => 'danger',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'active' => 'Aktif',
                    'inactive' => 'Tidak Aktif',
                    'suspended' => 'Ditangguhkan',
                }),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Terdaftar')
                ->dateTime('d M Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'active' => 'Aktif',
                    'inactive' => 'Tidak Aktif',
                    'suspended' => 'Ditangguhkan',
                ]),

            Tables\Filters\Filter::make('membership_expiring')
                ->label('Akan Berakhir')
                ->query(fn ($query) => $query->where('membership_end', '<=', now()->addMonth())),
        ])
        ->recordActions([
            
        ])
        ->toolbarActions([

        ]);
}

public static function getRelations(): array
{
    return [
        // Kita akan tambahkan relation manager nanti
    ];
}

public static function getPages(): array
{
    return [
        'index' => Pages\ListMembers::route('/'),
        'create' => Pages\CreateMember::route('/create'),
        'edit' => Pages\EditMember::route('/{record}/edit'),
    ];
}


}
