<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravolt\Indonesia\Facade as Indonesia;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\Grid as InfoGrid;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Pendaftaran';

    protected static ?string $modelLabel = 'Pendaftaran';

    protected static ?string $pluralModelLabel = 'Data Pendaftaran';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Section Informasi Produk
            Section::make('Informasi Produk')
                ->description('Pilih produk yang ingin didaftarkan')
                ->icon('heroicon-o-shopping-bag')
                ->schema([
                    Select::make('product_id')
                        ->relationship('product', 'name')
                        ->label('Produk')
                        ->placeholder('Pilih produk...')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(false),

            // Section Data Pribadi
            Section::make('Data Pribadi')
                ->description('Informasi pribadi pendaftar')
                ->icon('heroicon-o-user')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Masukkan nama lengkap')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete('name'),

                        TextInput::make('phone')
                            ->label('Nomor HP')
                            ->placeholder('08xx-xxxx-xxxx')
                            ->tel()
                            ->maxLength(20)
                            ->prefix('+62')
                            ->autocomplete('tel'),
                    ]),

                    TextInput::make('email')
                        ->label('Email')
                        ->placeholder('nama@email.com')
                        ->email()
                        ->maxLength(255)
                        ->autocomplete('email')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            // Section Alamat
            Section::make('Informasi Alamat')
                ->description('Alamat lengkap pendaftar')
                ->icon('heroicon-o-map-pin')
                ->schema([
                    Grid::make(2)->schema([
                        // PROVINSI
                        Select::make('province_code')
                            ->label('Provinsi')
                            ->placeholder('Pilih provinsi...')
                            ->options(\Laravolt\Indonesia\Models\Province::pluck('name', 'code'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($set) {
                                $set('city_code', null);
                                $set('district_code', null);
                                $set('village_code', null);
                            }),

                        // KOTA
                        Select::make('city_code')
                            ->label('Kota/Kabupaten')
                            ->placeholder('Pilih kota/kabupaten...')
                            ->options(
                                fn($get) =>
                                $get('province_code')
                                    ? \Laravolt\Indonesia\Models\City::where('province_code', $get('province_code'))->pluck('name', 'code')
                                    : []
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($set) {
                                $set('district_code', null);
                                $set('village_code', null);
                            }),

                        // KECAMATAN
                        Select::make('district_code')
                            ->label('Kecamatan')
                            ->placeholder('Pilih kecamatan...')
                            ->options(
                                fn($get) =>
                                $get('city_code')
                                    ? \Laravolt\Indonesia\Models\District::where('city_code', $get('city_code'))->pluck('name', 'code')
                                    : []
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn($set) => $set('village_code', null)),

                        // KELURAHAN
                        Select::make('village_code')
                            ->label('Kelurahan/Desa')
                            ->placeholder('Pilih kelurahan/desa...')
                            ->options(
                                fn($get) =>
                                $get('district_code')
                                    ? \Laravolt\Indonesia\Models\Village::where('district_code', $get('district_code'))->pluck('name', 'code')
                                    : []
                            )
                            ->searchable()
                            ->preload(),
                    ]),

                    Textarea::make('alamat_spesifik')
                        ->label('Alamat Spesifik')
                        ->placeholder('Masukkan alamat lengkap (nama jalan, nomor rumah, RT/RW, dll)')
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        TextInput::make('koordinat')
                            ->label('Koordinat GPS')
                            ->placeholder('Contoh: -6.200000, 106.816666')
                            ->helperText('Format: latitude, longitude (opsional)')
                            ->maxLength(50),

                        TextInput::make('referral')
                            ->label('Kode Referral')
                            ->placeholder('Masukkan kode referral (opsional)')
                            ->maxLength(100),
                    ]),
                ])
                ->collapsible(),

            // Section Status
            Section::make('Status Pendaftaran')
                ->description('Status persetujuan pendaftaran')
                ->icon('heroicon-o-check-circle')
                ->schema([
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending' => 'Pending',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                        ])
                        ->default('pending')
                        ->required()
                        ->native(false),
                ])
                ->collapsible()
                ->collapsed(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-user'),

                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('phone')
                    ->label('No. HP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor HP disalin!')
                    ->icon('heroicon-o-phone')
                    ->placeholder('Tidak ada'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-o-envelope')
                    ->placeholder('Tidak ada')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('province.name')
                    ->label('Provinsi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('city.name')
                    ->label('Kota/Kabupaten')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('district.name')
                    ->label('Kecamatan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('village.name')
                    ->label('Kelurahan/Desa')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'approved' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    }),

                TextColumn::make('koordinat')
                    ->label('Lokasi GPS')
                    ->formatStateUsing(fn($state) => $state ?: 'Tidak ada')
                    ->url(fn($record) => $record->koordinat ? "https://maps.google.com/?q={$record->koordinat}" : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-map')
                    ->color('primary')
                    ->tooltip('Klik untuk buka di Google Maps')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('referral')
                    ->label('Referral')
                    ->placeholder('Tidak ada')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-calendar'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->multiple(),

                SelectFilter::make('product')
                    ->relationship('product', 'name')
                    ->label('Produk')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Lihat')
                        ->icon('heroicon-o-eye'),
                    EditAction::make()
                        ->label('Edit')
                        ->icon('heroicon-o-pencil'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    // Bulk action untuk update product dan status
                    BulkAction::make('updateProductStatus')
                        ->label('Update Produk & Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->form([
                            Select::make('product_id')
                                ->label('Produk')
                                ->relationship('product', 'name')
                                ->placeholder('Pilih produk...')
                                ->searchable()
                                ->preload(),

                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'pending' => 'Pending',
                                    'approved' => 'Disetujui',
                                    'rejected' => 'Ditolak',
                                ])
                                ->placeholder('Pilih status...')
                                ->native(false),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $updateData = [];

                            // Hanya update field yang diisi
                            if (!empty($data['product_id'])) {
                                $updateData['product_id'] = $data['product_id'];
                            }

                            if (!empty($data['status'])) {
                                $updateData['status'] = $data['status'];
                            }

                            // Jika tidak ada data yang diupdate, tampilkan pesan error
                            if (empty($updateData)) {
                                Notification::make()
                                    ->title('Gagal!')
                                    ->body('Pilih minimal satu field (Produk atau Status) untuk diupdate.')
                                    ->warning()
                                    ->send();
                                return;
                            }

                            $records->each(function ($record) use ($updateData) {
                                $record->update($updateData);
                            });

                            $message = 'Berhasil update ';
                            $updates = [];
                            if (isset($updateData['product_id'])) $updates[] = 'produk';
                            if (isset($updateData['status'])) $updates[] = 'status';
                            $message .= implode(' dan ', $updates) . ' untuk ' . $records->count() . ' data.';

                            Notification::make()
                                ->title('Berhasil!')
                                ->body($message)
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Update Produk & Status')
                        ->modalDescription('Pilih field yang ingin diupdate. Field yang dikosongkan tidak akan diubah.')
                        ->modalSubmitActionLabel('Update'),

                    // Bulk action khusus untuk approve
                    BulkAction::make('bulkApprove')
                        ->label('Setujui Semua')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $records->each(function ($record) {
                                $record->update(['status' => 'approved']);
                            });

                            Notification::make()
                                ->title('Berhasil!')
                                ->body($records->count() . ' pendaftaran berhasil disetujui.')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Setujui Pendaftaran')
                        ->modalDescription('Apakah Anda yakin ingin menyetujui semua pendaftaran yang dipilih?')
                        ->modalSubmitActionLabel('Setujui'),

                    // Bulk action khusus untuk reject
                    BulkAction::make('bulkReject')
                        ->label('Tolak Semua')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Textarea::make('reason')
                                ->label('Alasan Penolakan')
                                ->placeholder('Masukkan alasan penolakan (opsional)')
                                ->rows(3)
                                ->maxLength(500),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each(function ($record) use ($data) {
                                $record->update([
                                    'status' => 'rejected',
                                    'rejection_reason' => $data['reason'] ?? null, // Jika ada field untuk alasan
                                ]);
                            });

                            Notification::make()
                                ->title('Berhasil!')
                                ->body($records->count() . ' pendaftaran berhasil ditolak.')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Tolak Pendaftaran')
                        ->modalDescription('Apakah Anda yakin ingin menolak semua pendaftaran yang dipilih?')
                        ->modalSubmitActionLabel('Tolak'),

                    // Bulk action untuk assign ke produk tertentu
                    BulkAction::make('assignProduct')
                        ->label('Assign Produk')
                        ->icon('heroicon-o-shopping-bag')
                        ->color('warning')
                        ->form([
                            Select::make('product_id')
                                ->label('Produk')
                                ->relationship('product', 'name')
                                ->placeholder('Pilih produk...')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each(function ($record) use ($data) {
                                $record->update(['product_id' => $data['product_id']]);
                            });

                            Notification::make()
                                ->title('Berhasil!')
                                ->body('Produk berhasil di-assign untuk ' . $records->count() . ' data.')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->modalHeading('Assign Produk')
                        ->modalDescription('Apakah Anda yakin ingin meng-assign produk untuk data yang dipilih?')
                        ->modalSubmitActionLabel('Assign'),

                    // Existing delete action
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
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
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
            'view' => Pages\ViewRegistration::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
