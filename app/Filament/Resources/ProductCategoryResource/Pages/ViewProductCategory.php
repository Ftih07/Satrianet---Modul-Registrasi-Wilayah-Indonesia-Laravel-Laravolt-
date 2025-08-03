<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use App\Filament\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Support\Enums\FontWeight;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toggle_status')
                ->label(fn() => $this->record->status ? 'Nonaktifkan Kategori' : 'Aktifkan Kategori')
                ->icon(fn() => $this->record->status ? 'heroicon-m-eye-slash' : 'heroicon-m-eye')
                ->color(fn() => $this->record->status ? 'danger' : 'success')
                ->requiresConfirmation()
                ->modalHeading(fn() => ($this->record->status ? 'Nonaktifkan' : 'Aktifkan') . ' Kategori')
                ->modalDescription(
                    fn() =>
                    $this->record->status
                        ? 'Kategori ini akan disembunyikan dari daftar kategori aktif. Produk dalam kategori ini tidak akan terpengaruh.'
                        : 'Kategori ini akan ditampilkan kembali dalam daftar kategori aktif.'
                )
                ->modalSubmitActionLabel(fn() => $this->record->status ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan')
                ->action(function () {
                    $this->record->update(['status' => !$this->record->status]);
                    $this->refreshFormData(['status']);
                }),

            Actions\EditAction::make()
                ->label('Edit Kategori')
                ->icon('heroicon-m-pencil-square')
                ->color('warning'),

            Actions\DeleteAction::make()
                ->label('Hapus Kategori')
                ->icon('heroicon-m-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Kategori')
                ->modalDescription('Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan dan akan mempengaruhi produk dalam kategori ini.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->color('danger'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Kategori')
                    ->description('Detail lengkap kategori produk')
                    ->icon('heroicon-m-tag')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Kategori')
                            ->icon('heroicon-m-tag')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->copyable()
                            ->copyMessage('Nama kategori berhasil disalin!')
                            ->placeholder('Tidak ada nama kategori'),

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

                Section::make('Deskripsi')
                    ->description('Penjelasan detail tentang kategori')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Deskripsi Kategori')
                            ->icon('heroicon-m-document-text')
                            ->placeholder('Tidak ada deskripsi')
                            ->columnSpanFull()
                            ->formatStateUsing(function ($state) {
                                return $state ?: 'Tidak ada deskripsi untuk kategori ini.';
                            })
                            ->color(fn($state) => $state ? 'primary' : 'gray'),
                    ]),

                Section::make('Statistik Kategori')
                    ->description('Data dan analitik kategori')
                    ->icon('heroicon-m-chart-bar')
                    ->schema([
                        TextEntry::make('products_count')
                            ->label('Total Produk')
                            ->icon('heroicon-m-cube')
                            ->getStateUsing(function ($record) {
                                return $record->products()->count();
                            })
                            ->badge()
                            ->color('info')
                            ->size('lg'),

                        TextEntry::make('active_products_count')
                            ->label('Produk Aktif')
                            ->icon('heroicon-m-check-circle')
                            ->getStateUsing(function ($record) {
                                return $record->products()->where('status', true)->count();
                            })
                            ->badge()
                            ->color('success'),

                        TextEntry::make('inactive_products_count')
                            ->label('Produk Tidak Aktif')
                            ->icon('heroicon-m-x-circle')
                            ->getStateUsing(function ($record) {
                                return $record->products()->where('status', false)->count();
                            })
                            ->badge()
                            ->color('danger'),
                    ])
                    ->columns(3),

                Section::make('Informasi Sistem')
                    ->description('Data teknis dan riwayat kategori')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
                            ->label('ID Kategori')
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
                    ->columns(3),

                Section::make('Status & Kondisi')
                    ->description('Ringkasan kondisi kategori')
                    ->icon('heroicon-m-information-circle')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('category_age')
                            ->label('Usia Kategori')
                            ->icon('heroicon-m-clock')
                            ->getStateUsing(function ($record) {
                                return $record->created_at->diffForHumans(null, true);
                            })
                            ->badge()
                            ->color('info'),

                        TextEntry::make('status_summary')
                            ->label('Ringkasan Status')
                            ->icon('heroicon-m-clipboard-document-list')
                            ->getStateUsing(function ($record) {
                                $status = [];
                                $status[] = $record->status ? '✅ Kategori Aktif' : '⏸️ Kategori Tidak Aktif';
                                $status[] = $record->description ? '✅ Ada Deskripsi' : '⚠️ Belum Ada Deskripsi';
                                $productsCount = $record->products()->count();
                                $status[] = $productsCount > 0 ? "✅ {$productsCount} Produk Terdaftar" : '📦 Belum Ada Produk';

                                return implode('<br>', $status);
                            })
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public function getBreadcrumb(): string
    {
        return $this->record->name;
    }
}
