<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Kategori Produk';

    protected static ?string $modelLabel = 'Kategori Produk';

    protected static ?string $pluralModelLabel = 'Kategori Produk';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kategori')
                    ->description('Masukkan detail informasi kategori produk')
                    ->icon('heroicon-m-tag')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama kategori')
                            ->prefixIcon('heroicon-m-tag')
                            ->unique(ignoreRecord: true)
                            ->validationAttribute('nama kategori')
                            ->helperText('Nama kategori harus unik dan mudah diingat')
                            ->live(onBlur: true),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Aktif')
                            ->required()
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan kategori ini')
                            ->inline(false)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),

                Section::make('Deskripsi Kategori')
                    ->description('Tambahkan penjelasan detail tentang kategori ini')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Jelaskan tentang kategori ini...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->helperText('Maksimal 1000 karakter. Deskripsi akan membantu pengguna memahami kategori ini.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-tag')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Nama kategori berhasil disalin!')
                    ->tooltip('Klik untuk menyalin nama kategori'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function ($record) {
                        return $record->description ? $record->description : 'Tidak ada deskripsi';
                    })
                    ->placeholder('Tidak ada deskripsi')
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable()
                    ->tooltip(fn($record) => $record->status ? 'Kategori aktif' : 'Kategori tidak aktif')
                    ->beforeStateUpdated(function ($record, $state) {
                        // Optional: Add logging or validation here
                    })
                    ->afterStateUpdated(function ($record, $state) {
                        // Optional: Add notification here
                    }),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('Jumlah Produk')
                    ->counts('products')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->tooltip('Total produk dalam kategori ini'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->tooltip('Tanggal pembuatan kategori')
                    ->since(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('Terakhir diperbarui')
                    ->since(),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label('Status Kategori')
                    ->placeholder('Semua kategori')
                    ->trueLabel('Hanya kategori aktif')
                    ->falseLabel('Hanya kategori tidak aktif')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', true),
                        false: fn(Builder $query) => $query->where('status', false),
                    ),

                Filter::make('has_products')
                    ->label('Kategori dengan Produk')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->has('products')),

                Filter::make('created_at')
                    ->label('Periode Pembuatan')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->placeholder('Pilih tanggal mulai'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->placeholder('Pilih tanggal akhir'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->color('warning'),
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn($record) => $record->status ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon(fn($record) => $record->status ? 'heroicon-m-eye-slash' : 'heroicon-m-eye')
                    ->color(fn($record) => $record->status ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn($record) => ($record->status ? 'Nonaktifkan' : 'Aktifkan') . ' Kategori')
                    ->modalDescription(
                        fn($record) =>
                        $record->status
                            ? 'Kategori ini akan disembunyikan dari daftar kategori aktif.'
                            : 'Kategori ini akan ditampilkan kembali dalam daftar kategori aktif.'
                    )
                    ->action(function ($record) {
                        $record->update(['status' => !$record->status]);
                    })
                    ->after(function () {
                        // Optional: Add notification
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Kategori')
                        ->modalDescription('Apakah Anda yakin ingin menghapus kategori yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan Terpilih')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Aktifkan Kategori')
                        ->modalDescription('Aktifkan semua kategori yang dipilih?')
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['status' => true]));
                        }),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan Terpilih')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Nonaktifkan Kategori')
                        ->modalDescription('Nonaktifkan semua kategori yang dipilih?')
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['status' => false]));
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum ada kategori produk')
            ->emptyStateDescription('Mulai dengan menambahkan kategori produk pertama.')
            ->emptyStateIcon('heroicon-o-squares-2x2')
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s')
            ->searchPlaceholder('Cari nama kategori...')
            ->deferLoading();
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'view' => Pages\ViewProductCategory::route('/{record}'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', true)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $activeCount = static::getModel()::where('status', true)->count();
        return $activeCount > 5 ? 'success' : 'warning';
    }
}
