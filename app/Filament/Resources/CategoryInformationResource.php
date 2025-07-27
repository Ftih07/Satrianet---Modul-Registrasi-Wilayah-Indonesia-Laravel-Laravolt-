<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryInformationResource\Pages;
use App\Filament\Resources\CategoryInformationResource\RelationManagers;
use App\Models\CategoryInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\Filter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;

class CategoryInformationResource extends Resource
{
    protected static ?string $model = CategoryInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $modelLabel = 'Kategori Informasi';

    protected static ?string $pluralModelLabel = 'Kategori Informasi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kategori')
                    ->description('Kelola informasi dasar kategori')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Kategori')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul kategori')
                                    ->helperText('Judul kategori akan digunakan untuk mengelompokkan informasi')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $context, $state, callable $set) {
                                        if ($context === 'create') {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    })
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('descriptions')
                                    ->label('Deskripsi')
                                    ->placeholder('Masukkan deskripsi kategori (opsional)')
                                    ->helperText('Deskripsi akan membantu pengguna memahami kategori ini')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->columnSpanFull()
                                    ->autosize(),
                            ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->copyable()
                    ->copyMessage('Judul berhasil disalin!')
                    ->tooltip(fn($record) => $record->title)
                    ->limit(40)
                    ->wrap(),

                Tables\Columns\TextColumn::make('descriptions')
                    ->label('Deskripsi')
                    ->limit(80)
                    ->tooltip(fn($record) => $record->descriptions)
                    ->wrap()
                    ->placeholder('Tidak ada deskripsi')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('informations_count')
                    ->label('Jumlah Info')
                    ->counts('informations')
                    ->badge()
                    ->color('primary')
                    ->tooltip('Jumlah informasi dalam kategori ini')
                    ->sortable()
                    ->toggleable(),

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
                Filter::make('has_description')
                    ->label('Memiliki Deskripsi')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('descriptions'))
                    ->toggle(),

                Filter::make('created_this_month')
                    ->label('Dibuat Bulan Ini')
                    ->query(fn(Builder $query): Builder => $query->whereMonth('created_at', now()->month))
                    ->toggle(),
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
                        ->modalHeading('Hapus Kategori')
                        ->modalDescription('Apakah Anda yakin ingin menghapus kategori ini? Semua informasi yang terkait dengan kategori ini akan kehilangan kategorinya.')
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
                        ->modalHeading('Hapus Kategori Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus kategori yang dipilih? Semua informasi yang terkait akan kehilangan kategorinya.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Kategori Baru')
                    ->icon('heroicon-o-plus'),
            ])
            ->emptyStateDescription('Belum ada kategori informasi yang dibuat. Klik tombol di bawah untuk membuat kategori pertama.')
            ->emptyStateHeading('Tidak Ada Kategori')
            ->emptyStateIcon('heroicon-o-tag')
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
                \Filament\Infolists\Components\Section::make('Detail Kategori')
                    ->schema([
                        \Filament\Infolists\Components\Grid::make(2)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Judul Kategori')
                                    ->weight(FontWeight::Bold)
                                    ->copyable(),
                                TextEntry::make('descriptions')
                                    ->label('')
                                    ->hiddenLabel()
                                    ->prose()
                                    ->placeholder('Tidak ada deskripsi')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                \Filament\Infolists\Components\Section::make('Informasi Sistem')
                    ->schema([
                        \Filament\Infolists\Components\Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat')
                                    ->dateTime('l, d F Y \p\u\k\u\l H:i:s'),

                                TextEntry::make('updated_at')
                                    ->label('Diperbarui')
                                    ->dateTime('l, d F Y \p\u\k\u\l H:i:s'),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\InformationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoryInformation::route('/'),
            'create' => Pages\CreateCategoryInformation::route('/create'),
            'view' => Pages\ViewCategoryInformation::route('/{record}'),
            'edit' => Pages\EditCategoryInformation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $count = static::getModel()::count();

        if ($count === 0) {
            return 'danger';
        } elseif ($count > 20) {
            return 'warning';
        }

        return 'primary';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'descriptions'];
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->title;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Deskripsi' => $record->descriptions ? \Illuminate\Support\Str::limit($record->descriptions, 50) : 'Tidak ada deskripsi',
        ];
    }
}
