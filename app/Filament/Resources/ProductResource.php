<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductSubcategory;
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
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Informasi utama produk')
                    ->icon('heroicon-m-cube')
                    ->schema([
                        Forms\Components\Select::make('product_subcategory_id')
                            ->relationship('subcategory', 'name', function (Builder $query) {
                                return $query->where('status', true);
                            })
                            ->label('Sub Kategori')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-m-rectangle-stack')
                            ->placeholder('Pilih sub kategori produk')
                            ->helperText('Pilih sub kategori untuk produk ini')
                            ->createOptionForm([
                                Forms\Components\Select::make('product_category_id')
                                    ->relationship('category', 'name')
                                    ->label('Kategori Utama')
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Sub Kategori')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('status')
                                    ->label('Status Aktif')
                                    ->default(true),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return ProductSubcategory::create($data)->id;
                            })
                            ->getOptionLabelFromRecordUsing(function ($record) {
                                return $record->category->name . ' → ' . $record->name;
                            }),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama produk')
                            ->prefixIcon('heroicon-m-cube')
                            ->live(onBlur: true)
                            ->helperText('Nama produk yang unik dan deskriptif')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Fitur Produk')
                    ->description('Daftar fitur-fitur unggulan produk')
                    ->icon('heroicon-m-star')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->label('Nama Fitur')
                                    ->required()
                                    ->placeholder('Masukkan nama fitur')
                                    ->prefixIcon('heroicon-m-check-circle'),
                            ])
                            ->defaultItems(1)
                            ->label('Fitur Produk')
                            ->addActionLabel('Tambah Fitur')
                            ->deleteAction(
                                fn($action) => $action->requiresConfirmation()
                            )
                            ->reorderableWithButtons()
                            ->collapsed()
                            ->itemLabel(fn(array $state): ?string => $state['feature'] ?? null)
                            ->columns(1)
                            ->columnSpanFull()
                            ->helperText('Tambahkan fitur-fitur unggulan produk Anda'),
                    ]),

                Section::make('Harga & Status')
                    ->description('Pengaturan harga dan status produk')
                    ->icon('heroicon-m-currency-dollar')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Produk')
                            ->numeric()
                            ->placeholder('0.00')
                            ->prefix('Rp')
                            ->prefixIcon('heroicon-m-currency-dollar')
                            ->step(0.01)
                            ->minValue(0)
                            ->maxValue(999999999.99)
                            ->helperText('Kosongkan jika harga akan ditentukan nanti')
                            ->formatStateUsing(function ($state) {
                                return $state ? number_format($state, 0, ',', '.') : '';
                            })
                            ->dehydrateStateUsing(function ($state) {
                                return $state ? (float) str_replace(['.', ','], ['', '.'], $state) : null;
                            }),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Aktif')
                            ->required()
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan produk')
                            ->inline(false)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subcategory.category.name')
                    ->label('Kategori')
                    ->icon('heroicon-m-squares-2x2')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->tooltip('Kategori utama produk')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('subcategory.name')
                    ->label('Sub Kategori')
                    ->icon('heroicon-m-rectangle-stack')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable()
                    ->tooltip('Sub kategori produk'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-cube')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Nama produk berhasil disalin!')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->name),

                Tables\Columns\TextColumn::make('features_count')
                    ->label('Jumlah Fitur')
                    ->getStateUsing(function ($record) {
                        return is_array($record->features) ? count($record->features) : 0;
                    })
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-star')
                    ->sortable()
                    ->tooltip('Total fitur produk'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->icon('heroicon-m-currency-dollar')
                    ->placeholder('Belum ditentukan')
                    ->color('success')
                    ->weight(FontWeight::Bold)
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Belum ditentukan';
                    }),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable()
                    ->tooltip(fn($record) => $record->status ? 'Produk aktif' : 'Produk tidak aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->since()
                    ->tooltip('Tanggal pembuatan produk'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since()
                    ->tooltip('Terakhir diperbarui'),
            ])
            ->filters([
                SelectFilter::make('product_subcategory_id')
                    ->label('Sub Kategori')
                    ->relationship('subcategory', 'name', function (Builder $query) {
                        return $query->where('status', true);
                    })
                    ->searchable()
                    ->preload()
                    ->placeholder('Semua sub kategori')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->category->name . ' → ' . $record->name;
                    }),

                SelectFilter::make('category')
                    ->label('Kategori Utama')
                    ->options(function () {
                        return \App\Models\ProductCategory::where('status', true)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->query(function (Builder $query, array $data) {
                        if ($data['value']) {
                            return $query->whereHas('subcategory.category', function (Builder $q) use ($data) {
                                $q->where('id', $data['value']);
                            });
                        }
                        return $query;
                    })
                    ->searchable()
                    ->placeholder('Semua kategori'),

                TernaryFilter::make('status')
                    ->label('Status Produk')
                    ->placeholder('Semua produk')
                    ->trueLabel('Hanya yang aktif')
                    ->falseLabel('Hanya yang tidak aktif')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', true),
                        false: fn(Builder $query) => $query->where('status', false),
                    ),

                Filter::make('price_range')
                    ->label('Range Harga')
                    ->form([
                        Forms\Components\TextInput::make('price_from')
                            ->label('Harga Minimum')
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('price_to')
                            ->label('Harga Maksimum')
                            ->numeric()
                            ->prefix('Rp'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn(Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_to'],
                                fn(Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),

                Filter::make('has_price')
                    ->label('Memiliki Harga')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('price')),

                Filter::make('has_features')
                    ->label('Memiliki Fitur')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('features')),

                Filter::make('created_at')
                    ->label('Periode Pembuatan')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
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
                    ->action(function ($record) {
                        $record->update(['status' => !$record->status]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Produk')
                        ->modalDescription('Apakah Anda yakin ingin menghapus produk yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus'),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan Terpilih')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['status' => true]));
                        }),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan Terpilih')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['status' => false]));
                        }),

                    Tables\Actions\BulkAction::make('update_prices')
                        ->label('Update Harga Massal')
                        ->icon('heroicon-m-currency-dollar')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('action_type')
                                ->label('Jenis Aksi')
                                ->options([
                                    'set' => 'Set Harga Tetap',
                                    'increase_percent' => 'Naikan Persentase',
                                    'decrease_percent' => 'Turunkan Persentase',
                                    'increase_amount' => 'Naikan Jumlah',
                                    'decrease_amount' => 'Turunkan Jumlah',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('value')
                                ->label('Nilai')
                                ->numeric()
                                ->required(),
                        ])
                        ->action(function ($records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $currentPrice = $record->price ?? 0;
                                $newPrice = $currentPrice;

                                switch ($data['action_type']) {
                                    case 'set':
                                        $newPrice = $data['value'];
                                        break;
                                    case 'increase_percent':
                                        $newPrice = $currentPrice * (1 + $data['value'] / 100);
                                        break;
                                    case 'decrease_percent':
                                        $newPrice = $currentPrice * (1 - $data['value'] / 100);
                                        break;
                                    case 'increase_amount':
                                        $newPrice = $currentPrice + $data['value'];
                                        break;
                                    case 'decrease_amount':
                                        $newPrice = $currentPrice - $data['value'];
                                        break;
                                }

                                $record->update(['price' => max(0, $newPrice)]);
                            });
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum ada produk')
            ->emptyStateDescription('Mulai dengan menambahkan produk pertama.')
            ->emptyStateIcon('heroicon-o-cube')
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->searchPlaceholder('Cari nama produk...')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', true)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $activeCount = static::getModel()::where('status', true)->count();
        return $activeCount > 20 ? 'success' : 'warning';
    }
}
