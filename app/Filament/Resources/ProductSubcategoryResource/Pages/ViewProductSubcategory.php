<?php

namespace App\Filament\Resources\ProductSubcategoryResource\Pages;

use App\Filament\Resources\ProductSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Support\Enums\FontWeight;

class ViewProductSubcategory extends ViewRecord
{
    protected static string $resource = ProductSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('toggle_status')
                ->label(fn() => $this->record->status ? 'Nonaktifkan Sub Kategori' : 'Aktifkan Sub Kategori')
                ->icon(fn() => $this->record->status ? 'heroicon-m-eye-slash' : 'heroicon-m-eye')
                ->color(fn() => $this->record->status ? 'danger' : 'success')
                ->requiresConfirmation()
                ->modalHeading(fn() => ($this->record->status ? 'Nonaktifkan' : 'Aktifkan') . ' Sub Kategori')
                ->modalDescription(
                    fn() =>
                    $this->record->status
                        ? 'Sub kategori ini akan disembunyikan dari daftar aktif.'
                        : 'Sub kategori ini akan ditampilkan kembali dalam daftar aktif.'
                )
                ->action(function () {
                    $this->record->update(['status' => !$this->record->status]);
                    $this->refreshFormData(['status']);
                }),

            Actions\EditAction::make()
                ->label('Edit Sub Kategori')
                ->icon('heroicon-m-pencil-square')
                ->color('warning'),

            Actions\DeleteAction::make()
                ->label('Hapus Sub Kategori')
                ->icon('heroicon-m-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Sub Kategori')
                ->modalDescription('Apakah Anda yakin ingin menghapus sub kategori ini? Tindakan ini tidak dapat dibatalkan.')
                ->color('danger'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Detail utama sub kategori produk')
                    ->icon('heroicon-m-tag')
                    ->schema([
                        TextEntry::make('category.name')
                            ->label('Kategori Utama')
                            ->icon('heroicon-m-squares-2x2')
                            ->badge()
                            ->color('info')
                            ->placeholder('Tidak ada kategori'),

                        TextEntry::make('name')
                            ->label('Nama Sub Kategori')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->icon('heroicon-m-tag')
                            ->copyable()
                            ->copyMessage('Nama sub kategori berhasil disalin!'),

                        TextEntry::make('sub_title')
                            ->label('Sub Judul')
                            ->icon('heroicon-m-document-text')
                            ->placeholder('Tidak ada sub judul')
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

                Section::make('Media & Konten')
                    ->description('Banner dan deskripsi sub kategori')
                    ->icon('heroicon-m-photo')
                    ->schema([
                        ImageEntry::make('banner')
                            ->label('Banner')
                            ->height(200)
                            ->width(400)
                            ->placeholder('/images/placeholder.png')
                            ->extraAttributes(['class' => 'rounded-lg'])
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->icon('heroicon-m-document-text')
                            ->placeholder('Tidak ada deskripsi')
                            ->formatStateUsing(function ($state) {
                                return $state ?: 'Tidak ada deskripsi untuk sub kategori ini.';
                            })
                            ->columnSpanFull()
                            ->color(fn($state) => $state ? 'primary' : 'gray'),
                    ]),

                Section::make('Fitur Sub Kategori')
                    ->description('Daftar fitur-fitur yang tersedia')
                    ->icon('heroicon-m-sparkles')
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

                Section::make('SEO & Teknis')
                    ->description('Informasi SEO dan pengaturan teknis')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('slug')
                            ->label('Slug URL')
                            ->icon('heroicon-m-link')
                            ->fontFamily('mono')
                            ->copyable()
                            ->copyMessage('Slug berhasil disalin!')
                            ->color('gray')
                            ->formatStateUsing(fn($state) => "/{$state}"),

                        TextEntry::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->icon('heroicon-m-hashtag')
                            ->placeholder('Tidak ada meta keywords')
                            ->formatStateUsing(function ($state) {
                                if (!$state) return 'Tidak ada meta keywords';
                                return collect(explode(',', $state))
                                    ->map(fn($keyword) => trim($keyword))
                                    ->join(', ');
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Informasi Sistem')
                    ->description('Data teknis dan riwayat')
                    ->icon('heroicon-m-server')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('id')
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
                    ->columns(3),

                Section::make('Statistik & Status')
                    ->description('Ringkasan informasi sub kategori')
                    ->icon('heroicon-m-chart-bar')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('features_count')
                            ->label('Jumlah Fitur')
                            ->icon('heroicon-m-sparkles')
                            ->getStateUsing(function ($record) {
                                return is_array($record->features) ? count($record->features) : 0;
                            })
                            ->badge()
                            ->color('info'),

                        TextEntry::make('subcategory_age')
                            ->label('Usia Sub Kategori')
                            ->icon('heroicon-m-clock')
                            ->getStateUsing(function ($record) {
                                return $record->created_at->diffForHumans(null, true);
                            })
                            ->badge()
                            ->color('success'),

                        TextEntry::make('completeness_status')
                            ->label('Status Kelengkapan')
                            ->icon('heroicon-m-clipboard-document-check')
                            ->getStateUsing(function ($record) {
                                $status = [];
                                $status[] = $record->status ? '✅ Status Aktif' : '⏸️ Status Tidak Aktif';
                                $status[] = $record->sub_title ? '✅ Ada Sub Judul' : '⚠️ Belum Ada Sub Judul';
                                $status[] = $record->description ? '✅ Ada Deskripsi' : '⚠️ Belum Ada Deskripsi';
                                $status[] = $record->banner ? '✅ Ada Banner' : '📷 Belum Ada Banner';
                                $status[] = $record->meta_keywords ? '✅ Ada Meta Keywords' : '🔍 Belum Ada Meta Keywords';
                                $featuresCount = is_array($record->features) ? count($record->features) : 0;
                                $status[] = $featuresCount > 0 ? "✅ {$featuresCount} Fitur" : '📝 Belum Ada Fitur';

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
