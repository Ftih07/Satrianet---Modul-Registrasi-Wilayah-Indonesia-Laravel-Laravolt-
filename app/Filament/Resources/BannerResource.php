<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $modelLabel = 'Banner';

    protected static ?string $pluralModelLabel = 'Banners';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Banner')
                    ->description('Kelola informasi dasar banner')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Banner')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul banner')
                                    ->helperText('Judul akan ditampilkan sebagai alt text gambar')
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('status')
                                    ->label('Status Aktif')
                                    ->helperText('Banner aktif akan ditampilkan di website')
                                    ->default(true)
                                    ->inline(false),
                            ]),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),

                Forms\Components\Section::make('Media')
                    ->description('Upload gambar banner')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Banner')
                            ->directory('banners')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048) // 2MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Format: JPEG, PNG, WebP. Maksimal 2MB. Rasio yang disarankan: 16:9')
                            ->imagePreviewHeight('200')
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('2:1')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/images/placeholder-banner.png'))
                    ->extraImgAttributes(['loading' => 'lazy']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->copyable()
                    ->copyMessage('Judul berhasil disalin!')
                    ->tooltip(fn($record) => $record->title)
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->tooltip(fn($record) => $record->status ? 'Aktif' : 'Tidak Aktif')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->tooltip(fn($record) => $record->created_at->format('l, d F Y \p\u\k\u\l H:i:s'))
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->tooltip(fn($record) => $record->updated_at->format('l, d F Y \p\u\k\u\l H:i:s'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label('Status')
                    ->placeholder('Semua Banner')
                    ->trueLabel('Hanya Aktif')
                    ->falseLabel('Hanya Tidak Aktif')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', true),
                        false: fn(Builder $query) => $query->where('status', false),
                        blank: fn(Builder $query) => $query,
                    ),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat')
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->label('Edit')
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Banner')
                        ->modalDescription('Apakah Anda yakin ingin menghapus banner ini? Data yang sudah dihapus tidak dapat dikembalikan.')
                        ->modalSubmitActionLabel('Ya, Hapus'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Banner Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus banner yang dipilih? Data yang sudah dihapus tidak dapat dikembalikan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Banner Baru')
                    ->icon('heroicon-o-plus'),
            ])
            ->emptyStateDescription('Belum ada banner yang dibuat. Klik tombol di bawah untuk membuat banner pertama.')
            ->emptyStateHeading('Tidak Ada Banner')
            ->emptyStateIcon('heroicon-o-photo')
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Detail Banner')
                    ->schema([
                        \Filament\Infolists\Components\Grid::make(2)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Judul')
                                    ->weight(FontWeight::Bold)
                                    ->copyable(),

                                IconEntry::make('status')
                                    ->label('Status')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),

                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('l, d F Y \p\u\k\u\l H:i:s'),

                                TextEntry::make('updated_at')
                                    ->label('Diperbarui')
                                    ->dateTime('l, d F Y \p\u\k\u\l H:i:s'),
                            ]),
                    ]),

                \Filament\Infolists\Components\Section::make('Preview Banner')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('')
                            ->hiddenLabel()
                            ->size('100%')
                            ->extraImgAttributes(['class' => 'rounded-lg shadow-md']),
                    ])
                    ->collapsible(),
            ]);
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'view' => Pages\ViewBanner::route('/{record}'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'warning' : 'primary';
    }
}
