<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationResource\Pages;
use App\Filament\Resources\InformationResource\RelationManagers;
use App\Models\Information;
use App\Models\CategoryInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;

class InformationResource extends Resource
{
    protected static ?string $model = Information::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $modelLabel = 'Informasi';

    protected static ?string $pluralModelLabel = 'Informasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Kelola informasi dasar artikel')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul informasi')
                                    ->helperText('Judul akan menjadi heading utama artikel')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('sub_title')
                                    ->label('Sub Judul')
                                    ->maxLength(255)
                                    ->placeholder('Masukkan sub judul (opsional)')
                                    ->helperText('Sub judul akan muncul di bawah judul utama')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Information::class, 'slug', ignoreRecord: true)
                                    ->helperText('URL-friendly version dari judul (otomatis dibuat)')
                                    ->placeholder('akan-dibuat-otomatis')
                                    ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'])
                                    ->validationMessages([
                                        'regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung.',
                                    ])
                                    ->columnSpan(1),

                                Forms\Components\Select::make('category_information_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'title')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul Kategori')
                                            ->required(),
                                        Forms\Components\Textarea::make('descriptions')
                                            ->label('Deskripsi'),
                                    ])
                                    ->createOptionUsing(function (array $data): int {
                                        return CategoryInformation::create($data)->getKey();
                                    })
                                    ->helperText('Pilih kategori untuk mengelompokkan informasi')
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),

                Section::make('Konten')
                    ->description('Tulis konten utama informasi')
                    ->icon('heroicon-o-pencil')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Konten')
                            ->required()
                            ->placeholder('Tuliskan konten informasi di sini...')
                            ->helperText('Gunakan toolbar untuk memformat teks')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),

                Section::make('Media')
                    ->description('Upload gambar untuk informasi')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Utama')
                            ->directory('informations')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
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

                Section::make('SEO & Meta')
                    ->description('Pengaturan untuk optimasi mesin pencari')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Textarea::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('kata kunci, dipisahkan, dengan, koma')
                                    ->helperText('Kata kunci untuk SEO, pisahkan dengan koma')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('status')
                                    ->label('Status Publikasi')
                                    ->helperText('Informasi aktif akan ditampilkan di website')
                                    ->default(true)
                                    ->inline(false)
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('Periode Promo')
                    ->description('Isi jika informasi ini bagian dari promo')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_date')
                                    ->label('Tanggal Mulai Promo')
                                    ->seconds(false)
                                    ->timezone('Asia/Jakarta') // optional biar waktu lokal
                                    ->helperText('Boleh dikosongkan jika tidak ada promo'),

                                Forms\Components\DateTimePicker::make('end_date')
                                    ->label('Tanggal Berakhir Promo')
                                    ->afterOrEqual('start_date')
                                    ->seconds(false)
                                    ->timezone('Asia/Jakarta')
                                    ->helperText('Boleh dikosongkan jika tidak ada promo'),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(url('/images/placeholder-article.png'))
                    ->extraImgAttributes(['loading' => 'lazy']),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->copyable()
                    ->copyMessage('Judul berhasil disalin!')
                    ->tooltip(fn($record) => $record->title)
                    ->limit(40)
                    ->wrap(),

                Tables\Columns\TextColumn::make('sub_title')
                    ->label('Sub Judul')
                    ->limit(30)
                    ->placeholder('Tidak ada sub judul')
                    ->color('gray')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->searchable()
                    ->tooltip(fn($record) => $record->category?->descriptions ?? 'Tidak ada deskripsi kategori'),

                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->tooltip(fn($record) => $record->status ? 'Dipublikasikan' : 'Draft')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai Promo')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('—')
                    ->color('info')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir Promo')
                    ->dateTime('d M Y H:i')
                    ->placeholder(fn($record) => $record->end_date ? null : 'Tanpa Batas')
                    ->color(fn($record) => $record->end_date === null ? 'gray' : 'danger'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin!')
                    ->limit(30)
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

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
                SelectFilter::make('category_information_id')
                    ->label('Kategori')
                    ->relationship('category', 'title')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('status')
                    ->label('Status Publikasi')
                    ->placeholder('Semua Status')
                    ->trueLabel('Hanya Dipublikasikan')
                    ->falseLabel('Hanya Draft')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', true),
                        false: fn(Builder $query) => $query->where('status', false),
                        blank: fn(Builder $query) => $query,
                    ),

                Filter::make('created_this_month')
                    ->label('Dibuat Bulan Ini')
                    ->query(fn(Builder $query): Builder => $query->whereMonth('created_at', now()->month))
                    ->toggle(),

                Filter::make('has_image')
                    ->label('Memiliki Gambar')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('image'))
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
                    Tables\Actions\Action::make('preview')
                        ->label('Preview Konten')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->modalHeading(fn($record) => 'Preview: ' . $record->title)
                        ->modalContent(fn($record) => view('filament.components.information-preview', ['record' => $record]))
                        ->modalWidth('7xl')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Tutup'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Informasi')
                        ->modalDescription('Apakah Anda yakin ingin menghapus informasi ini? Data yang sudah dihapus tidak dapat dikembalikan.')
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
                        ->modalHeading('Hapus Informasi Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus informasi yang dipilih? Data yang sudah dihapus tidak dapat dikembalikan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),

                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publikasikan Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each->update(['status' => true]);
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('draft')
                        ->label('Jadikan Draft')
                        ->icon('heroicon-o-document')
                        ->color('warning')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each->update(['status' => false]);
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Informasi Baru')
                    ->icon('heroicon-o-plus'),
            ])
            ->emptyStateDescription('Belum ada informasi yang dibuat. Klik tombol di bawah untuk membuat informasi pertama.')
            ->emptyStateHeading('Tidak Ada Informasi')
            ->emptyStateIcon('heroicon-o-document-text')
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
                \Filament\Infolists\Components\Section::make('Informasi Utama')
                    ->schema([
                        \Filament\Infolists\Components\Grid::make(2)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Judul')
                                    ->weight(FontWeight::Bold)
                                    ->size('lg')
                                    ->copyable()
                                    ->columnSpanFull(),

                                TextEntry::make('sub_title')
                                    ->label('Sub Judul')
                                    ->placeholder('Tidak ada sub judul')
                                    ->columnSpanFull(),

                                TextEntry::make('slug')
                                    ->label('Slug')
                                    ->badge()
                                    ->color('gray')
                                    ->copyable(),

                                TextEntry::make('category.title')
                                    ->label('Kategori')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn($record) => $record->status ? 'success' : 'danger')
                                    ->formatStateUsing(fn($state) => $state ? 'Dipublikasikan' : 'Draft'),

                                TextEntry::make('start_date')
                                    ->label('Mulai Promo')
                                    ->dateTime('d M Y H:i')
                                    ->placeholder('—'),

                                TextEntry::make('end_date')
                                    ->label('Berakhir Promo')
                                    ->dateTime('d M Y H:i')
                                    ->placeholder(fn($record) => $record->end_date ? null : 'Tanpa Batas'),
                            ]),
                    ]),

                \Filament\Infolists\Components\Section::make('Gambar')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('')
                            ->hiddenLabel()
                            ->size('100%')
                            ->extraImgAttributes(['class' => 'rounded-lg shadow-md']),
                    ])
                    ->collapsible()
                    ->visible(fn($record) => !empty($record->image)),

                \Filament\Infolists\Components\Section::make('Konten')
                    ->schema([
                        TextEntry::make('content')
                            ->label('')
                            ->hiddenLabel()
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                \Filament\Infolists\Components\Section::make('SEO & Meta')
                    ->schema([
                        TextEntry::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('Tidak ada meta keywords')
                            ->badge()
                            ->separator(',')
                            ->color('gray')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->visible(fn($record) => !empty($record->meta_keywords)),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformation::route('/'),
            'create' => Pages\CreateInformation::route('/create'),
            'view' => Pages\ViewInformation::route('/{record}'),
            'edit' => Pages\EditInformation::route('/{record}/edit'),
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
        } elseif ($count > 50) {
            return 'warning';
        }

        return 'primary';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'sub_title', 'content', 'meta_keywords'];
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->title;
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Kategori' => $record->category?->title ?? 'Tidak ada kategori',
            'Status' => $record->status ? 'Dipublikasikan' : 'Draft',
        ];
    }
}
