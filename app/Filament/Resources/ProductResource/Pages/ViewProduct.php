<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Support\Enums\FontWeight;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toggle_status')
                ->label(fn() => $this->record->status ? 'Nonaktifkan Produk' : 'Aktifkan Produk')
                ->icon(fn() => $this->record->status ? 'heroicon-m-eye-slash' : 'heroicon-m-eye')
                ->color(fn() => $this->record->status ? 'danger' : 'success')
                ->requiresConfirmation()
                ->modalHeading(fn() => ($this->record->status ? 'Nonaktifkan' : 'Aktifkan') . ' Produk')
                ->modalDescription(
                    fn() =>
                    $this->record->status
                        ? 'Produk ini akan disembunyikan dari katalog.'
                        : 'Produk ini akan ditampilkan kembali dalam katalog.'
                )
                ->action(function () {
                    $this->record->update(['status' => !$this->record->status]);
                    $this->refreshFormData(['status']);
                }),

            Actions\Action::make('update_price')
                ->label('Update Harga')
                ->icon('heroicon-m-currency-dollar')
                ->color('warning')
                ->form([
                    \Filament\Forms\Components\TextInput::make('new_price')
                        ->label('Harga Baru')
                        ->numeric()
                        ->prefix('Rp')
                        ->placeholder('Masukkan harga baru')
                        ->default($this->record->price)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $this->record->update(['price' => $data['new_price']]);
                    $this->refreshFormData(['price']);
                }),

            Actions\EditAction::make()
                ->label('Edit Produk')
                ->icon('heroicon-m-pencil-square')
                ->color('warning'),

            Actions\DeleteAction::make()
                ->label('Hapus Produk')
                ->icon('heroicon-m-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Produk')
                ->modalDescription('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')
                ->color('danger'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Produk')
                    ->description('Detail lengkap produk')
                    ->icon('heroicon-m-cube')
                    ->schema([
                        TextEntry::make('subcategory.category.name')
                            ->label('Kategori Utama')
                            ->icon('heroicon-m-squares-2x2')
                            ->badge()
                            ->color('primary'),

                        TextEntry::make('subcategory.name')
                            ->label('Sub Kategori')
                            ->icon('heroicon-m-rectangle-stack')
                            ->badge()
                            ->color('info'),

                        TextEntry::make('name')
                            ->label('Nama Produk')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->icon('heroicon-m-cube')
                            ->copyable()
                            ->copyMessage('Nama produk berhasil disalin!')
                            ->columnSpanFull(),

                        IconEntry::make('status')
                            ->label('Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger')
                            ->size('lg'),
                    ])
                    ->columns(2),

                Section::make('Harga & Nilai')
                    ->description('Informasi harga dan nilai produk')
                    ->icon('heroicon-m-currency-dollar')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Harga Produk')
                            ->icon('heroicon-m-currency-dollar')
                            ->placeholder('Belum ditentukan')
                            ->formatStateUsing(function ($state) {
                                return $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Belum ditentukan';
                            })
                            ->color(fn($state) => $state ? 'success' : 'gray')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->copyable()
                            ->copyMessage('Harga berhasil disalin!'),

                        TextEntry::make('price_category')
                            ->label('Kategori Harga')
                            ->icon('heroicon-m-tag')
                            ->getStateUsing(function ($record) {
                                if (!$record->price) return 'Tidak ada harga';

                                if ($record->price < 100000) return 'Ekonomis';
                                if ($record->price < 500000) return 'Menengah';
                                if ($record->price < 1000000) return 'Premium';
                                return 'Luxury';
                            })
                            ->badge()
                            ->color(function ($record) {
                                if (!$record->price) return 'gray';

                                if ($record->price < 100000) return 'success';
                                if ($record->price < 500000) return 'info';
                                if ($record->price < 1000000) return 'warning';
                                return 'danger';
                            }),
                    ])
                    ->columns(2),

                Section::make('Fitur Produk')
                    ->description('Daftar fitur-fitur unggulan')
                    ->icon('heroicon-m-star')
                    ->schema([
                        RepeatableEntry::make('features')
                            ->label('Daftar Fitur')
                            ->schema([
                                TextEntry::make('feature')
                                    ->label('')
                                    ->icon('heroicon-m-check-circle')
                                    ->color('success')
                                    ->weight(FontWeight::Medium),
                            ])
                            ->grid(2)
                            ->columnSpanFull()
                            ->placeholder('Belum ada fitur yang ditambahkan'),
                    ]),

                Section::make('Hierarki Kategori')
                    ->description('Struktur kategori produk')
                    ->icon('heroicon-m-arrow-trending-up')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('category_hierarchy')
                            ->label('Jalur Kategori')
                            ->icon('heroicon-m-arrow-right')
                            ->getStateUsing(function ($record) {
                                $category = $record->subcategory->category->name ?? 'Tidak ada kategori';
                                $subcategory = $record->subcategory->name ?? 'Tidak ada sub kategori';
                                $product = $record->name;

                                return "{$category} → {$subcategory} → {$product}";
                            })
                            ->copyable()
                            ->copyMessage('Jalur kategori berhasil disalin!')
                            ->columnSpanFull()
                            ->color('primary'),

                        TextEntry::make('subcategory.slug')
                            ->label('Slug Sub Kategori')
                            ->icon('heroicon-m-link')
                            ->fontFamily('mono')
                            ->copyable()
                            ->color('gray')
                            ->placeholder('Tidak ada slug'),

                        TextEntry::make('subcategory.description')
                            ->label('Deskripsi Sub Kategori')
                            ->icon('heroicon-m-document-text')
                            ->placeholder('Tidak ada deskripsi')
                            ->limit(100)
                            ->tooltip(fn($record) => $record->subcategory->description)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Informasi Sistem')
                    ->description('Data teknis dan riwayat')
                    ->icon('heroicon-m-server')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label('ID Produk')
                            ->icon('heroicon-m-hashtag')
                            ->badge()
                            ->color('gray'),

                        TextEntry::make('product_subcategory_id')
                            ->label('ID Sub Kategori')
                            ->icon('heroicon-m-hashtag')
                            ->badge()
                            ->color('gray'),

                        TextEntry::make('created_at')
                            ->label('Tanggal Dibuat')
                            ->icon('heroicon-m-calendar-days')
                            ->dateTime('d F Y, H:i')
                            ->color('success')
                            ->formatStateUsing(function ($state) {
                                return $state->format('d F Y, H:i') . ' WIB';
                            })
                            ->helperText(function ($record) {
                                return 'Dibuat ' . $record->created_at->diffForHumans();
                            }),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->icon('heroicon-m-arrow-path')
                            ->dateTime('d F Y, H:i')
                            ->color('warning')
                            ->formatStateUsing(function ($state) {
                                return $state->format('d F Y, H:i') . ' WIB';
                            })
                            ->helperText(function ($record) {
                                return 'Diperbarui ' . $record->updated_at->diffForHumans();
                            }),
                    ])
                    ->columns(2),

                Section::make('Statistik & Analisis')
                    ->description('Analisis dan ringkasan produk')
                    ->icon('heroicon-m-chart-bar')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('features_count')
                            ->label('Jumlah Fitur')
                            ->icon('heroicon-m-star')
                            ->getStateUsing(function ($record) {
                                return is_array($record->features) ? count($record->features) : 0;
                            })
                            ->badge()
                            ->color('info'),

                        TextEntry::make('product_age')
                            ->label('Usia Produk')
                            ->icon('heroicon-m-clock')
                            ->getStateUsing(function ($record) {
                                return $record->created_at->diffForHumans(null, true);
                            })
                            ->badge()
                            ->color('success'),

                        TextEntry::make('price_per_feature')
                            ->label('Harga per Fitur')
                            ->icon('heroicon-m-calculator')
                            ->getStateUsing(function ($record) {
                                $featuresCount = is_array($record->features) ? count($record->features) : 0;
                                if (!$record->price || $featuresCount === 0) {
                                    return 'Tidak dapat dihitung';
                                }
                                $pricePerFeature = $record->price / $featuresCount;
                                return 'Rp ' . number_format($pricePerFeature, 0, ',', '.');
                            })
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('completeness_status')
                            ->label('Status Kelengkapan')
                            ->icon('heroicon-m-clipboard-document-check')
                            ->getStateUsing(function ($record) {
                                $status = [];
                                $status[] = $record->status ? '✅ Status Aktif' : '⏸️ Status Tidak Aktif';
                                $status[] = $record->price ? '✅ Ada Harga' : '💰 Belum Ada Harga';
                                $featuresCount = is_array($record->features) ? count($record->features) : 0;
                                $status[] = $featuresCount > 0 ? "✅ {$featuresCount} Fitur" : '📝 Belum Ada Fitur';
                                $status[] = $record->subcategory ? '✅ Ada Sub Kategori' : '📂 Belum Ada Sub Kategori';

                                return implode('<br>', $status);
                            })
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public function getBreadcrumb(): string
    {
        return $this->record->name;
    }
}
