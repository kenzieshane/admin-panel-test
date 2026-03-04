<?php
namespace App\Filament\Resources\Members;
use App\Filament\Resources\Members\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
class MemberResource extends Resource
{
protected static ?string $model = Member::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

protected static ?string $navigationLabel = 'Anggota';

    protected static string | \UnitEnum | null $navigationGroup = 'Manajemen Anggota';

protected static ?int $navigationSort = 1;

public static function form(Schema $schema): Schema
{
    return $schema
        ->schema([
            Forms\Components\Section::make('Informasi Pribadi')
                ->schema([
                    Forms\Components\TextInput::make('member_code')
                        ->label('Kode Anggota')
                        ->default(fn () => 'MBR-' . strtoupper(Str::random(6)))
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    Forms\Components\TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->tel()
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\DatePicker::make('date_of_birth')
                        ->label('Tanggal Lahir')
                        ->maxDate(now()->subYears(5)),

                    Forms\Components\Select::make('gender')
                        ->label('Jenis Kelamin')
                        ->options([
                            'male' => 'Laki-laki',
                            'female' => 'Perempuan',
                        ])
                        ->required(),

                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->directory('member-photos')
                        ->imageEditor()
                        ->circleCropper(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Status Keanggotaan')
                ->schema([
                    Forms\Components\DatePicker::make('membership_start')
                        ->label('Tanggal Mulai')
                        ->required()
                        ->default(now()),

                    Forms\Components\DatePicker::make('membership_end')
                        ->label('Tanggal Berakhir')
                        ->required()
                        ->default(now()->addYear()),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'active' => 'Aktif',
                            'inactive' => 'Tidak Aktif',
                            'suspended' => 'Ditangguhkan',
                        ])
                        ->required()
                        ->default('active'),
                ])
                ->columns(3),
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
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('generateQR')
                ->label('Generate QR')
                ->icon('heroicon-o-qr-code')
                ->action(function (Member $record) {
                    // Kita akan implementasi di Bab 6
                }),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
