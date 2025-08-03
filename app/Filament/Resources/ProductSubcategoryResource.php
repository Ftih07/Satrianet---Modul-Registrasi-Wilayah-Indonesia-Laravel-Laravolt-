<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductSubcategoryResource\Pages;
use App\Filament\Resources\ProductSubcategoryResource\RelationManagers;
use App\Models\ProductSubcategory;
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
use Illuminate\Support\Str;

class ProductSubcategoryResource extends Resource
{
    protected static ?string $model = ProductSubcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationLabel = 'Sub Kategori Produk';

    protected static ?string $modelLabel = 'Sub Kategori';

    protected static ?string $pluralModelLabel = 'Sub Kategori Produk';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Informasi utama sub kategori produk')
                    ->icon('heroicon-m-tag')
                    ->schema([
                        Forms\Components\Select::make('product_category_id')
                            ->relationship('category', 'name')
                            ->label('Kategori Utama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-m-squares-2x2')
                            ->placeholder('Pilih kategori utama')
                            ->helperText('Pilih kategori utama untuk sub kategori ini')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Kategori')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('status')
                                    ->label('Status Aktif')
                                    ->default(true),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return ProductCategory::create($data)->id;
                            }),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Sub Kategori')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama sub kategori')
                            ->prefixIcon('heroicon-m-tag')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            })
                            ->helperText('Nama akan otomatis menghasilkan slug'),

                        Forms\Components\TextInput::make('sub_title')
                            ->label('Sub Judul')
                            ->maxLength(255)
                            ->placeholder('Masukkan sub judul (opsional)')
                            ->prefixIcon('heroicon-m-document-text')
                            ->helperText('Sub judul untuk deskripsi singkat')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Fitur Produk')
                    ->description('Daftar fitur-fitur sub kategori')
                    ->icon('heroicon-m-sparkles')
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
                            ->label('Fitur Sub Kategori')
                            ->addActionLabel('Tambah Fitur')
                            ->deleteAction(
                                fn($action) => $action->requiresConfirmation()
                            )
                            ->reorderableWithButtons()
                            ->collapsed()
                            ->itemLabel(fn(array $state): ?string => $state['feature'] ?? null)
                            ->columns(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Konten & Media')
                    ->description('Deskripsi dan gambar banner')
                    ->icon('heroicon-m-photo')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Jelaskan tentang sub kategori ini...')
                            ->rows(4)
                            ->maxLength(2000)
                            ->helperText('Maksimal 2000 karakter')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('banner')
                            ->label('Banner')
                            ->directory('subcategory-banners')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload gambar banner (maksimal 2MB, format: JPG, PNG, WebP)')
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO & Pengaturan')
                    ->description('Pengaturan slug, meta keywords, dan status')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('url-friendly-slug')
                            ->prefixIcon('heroicon-m-link')
                            ->unique(ignoreRecord: true)
                            ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'])
                            ->validationAttribute('slug')
                            ->helperText('Format: huruf kecil, angka, dan tanda hubung (-)')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('keyword1, keyword2, keyword3')
                            ->rows(3)
                            ->helperText('Pisahkan dengan koma untuk SEO')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Aktif')
                            ->required()
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan sub kategori')
                            ->inline(false)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori Utama')
                    ->icon('heroicon-m-squares-2x2')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable()
                    ->tooltip('Kategori induk'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Sub Kategori')
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-tag')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Nama sub kategori berhasil disalin!'),

                Tables\Columns\TextColumn::make('sub_title')
                    ->label('Sub Judul')
                    ->limit(30)
                    ->placeholder('Tidak ada sub judul')
                    ->searchable()
                    ->toggleable()
                    ->tooltip(fn($record) => $record->sub_title),

                Tables\Columns\ImageColumn::make('banner')
                    ->label('Banner')
                    ->circular()
                    ->defaultImageUrl('/images/placeholder.png')
                    ->tooltip('Klik untuk melihat gambar penuh')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->icon('heroicon-m-link')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin!')
                    ->color('gray')
                    ->fontFamily('mono')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('features_count')
                    ->label('Jumlah Fitur')
                    ->getStateUsing(function ($record) {
                        return is_array($record->features) ? count($record->features) : 0;
                    })
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-sparkles')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable()
                    ->tooltip(fn($record) => $record->status ? 'Sub kategori aktif' : 'Sub kategori tidak aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->since(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('product_category_id')
                    ->label('Kategori Utama')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Semua kategori'),

                TernaryFilter::make('status')
                    ->label('Status Sub Kategori')
                    ->placeholder('Semua sub kategori')
                    ->trueLabel('Hanya yang aktif')
                    ->falseLabel('Hanya yang tidak aktif')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', true),
                        false: fn(Builder $query) => $query->where('status', false),
                    ),

                Filter::make('has_banner')
                    ->label('Memiliki Banner')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('banner')),

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
                        ->modalHeading('Hapus Sub Kategori')
                        ->modalDescription('Apakah Anda yakin ingin menghapus sub kategori yang dipilih?')
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
                ]),
            ])
            ->emptyStateHeading('Belum ada sub kategori')
            ->emptyStateDescription('Mulai dengan menambahkan sub kategori pertama.')
            ->emptyStateIcon('heroicon-o-square-3-stack-3d')
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->searchPlaceholder('Cari nama sub kategori...')
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
            'index' => Pages\ListProductSubcategories::route('/'),
            'create' => Pages\CreateProductSubcategory::route('/create'),
            'view' => Pages\ViewProductSubcategory::route('/{record}'),
            'edit' => Pages\EditProductSubcategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', true)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $activeCount = static::getModel()::where('status', true)->count();
        return $activeCount > 10 ? 'success' : 'warning';
    }
}
