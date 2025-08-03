<?php

namespace App\Filament\Resources\RegistrationResource\Pages;

use App\Filament\Resources\RegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\ImageEntry;

class ViewRegistration extends ViewRecord
{
    protected static string $resource = RegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Data')
                ->icon('heroicon-o-pencil'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Section Status dan Produk
                Section::make('Status Pendaftaran')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('status')
                                ->label('Status')
                                ->badge()
                                ->color(fn($state) => match ($state) {
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'gray',
                                })
                                ->icon(fn($state) => match ($state) {
                                    'pending' => 'heroicon-o-clock',
                                    'approved' => 'heroicon-o-check-circle',
                                    'rejected' => 'heroicon-o-x-circle',
                                    default => 'heroicon-o-question-mark-circle',
                                })
                                ->formatStateUsing(fn($state) => match ($state) {
                                    'pending' => 'Pending',
                                    'approved' => 'Disetujui',
                                    'rejected' => 'Ditolak',
                                    default => $state,
                                }),

                            TextEntry::make('product.name')
                                ->label('Produk')
                                ->badge()
                                ->color('info')
                                ->icon('heroicon-o-shopping-bag'),

                            TextEntry::make('created_at')
                                ->label('Tanggal Daftar')
                                ->dateTime('d M Y, H:i')
                                ->icon('heroicon-o-calendar')
                                ->color('gray'),
                        ]),
                    ])
                    ->columnSpanFull(),

                // Section Data Pribadi
                Section::make('Data Pribadi')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Nama Lengkap')
                                ->weight(FontWeight::Bold)
                                ->icon('heroicon-o-user')
                                ->copyable()
                                ->copyMessage('Nama disalin!')
                                ->size('lg'),

                            TextEntry::make('email')
                                ->label('Email')
                                ->icon('heroicon-o-envelope')
                                ->copyable()
                                ->copyMessage('Email disalin!')
                                ->placeholder('Tidak ada email')
                                ->url(fn($state) => $state ? "mailto:{$state}" : null)
                                ->color('primary'),
                        ]),

                        TextEntry::make('phone')
                            ->label('Nomor HP')
                            ->icon('heroicon-o-phone')
                            ->copyable()
                            ->copyMessage('Nomor HP disalin!')
                            ->placeholder('Tidak ada nomor HP')
                            ->url(fn($state) => $state ? "tel:{$state}" : null)
                            ->color('primary'),
                    ])
                    ->columns(1),

                // Section Alamat Lengkap
                Section::make('Informasi Alamat')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('province.name')
                                ->label('Provinsi')
                                ->icon('heroicon-o-building-office-2')
                                ->placeholder('Data tidak tersedia'),

                            TextEntry::make('city.name')
                                ->label('Kota/Kabupaten')
                                ->icon('heroicon-o-building-office')
                                ->placeholder('Data tidak tersedia'),

                            TextEntry::make('district.name')
                                ->label('Kecamatan')
                                ->icon('heroicon-o-map')
                                ->placeholder('Data tidak tersedia'),

                            TextEntry::make('village.name')
                                ->label('Kelurahan/Desa')
                                ->icon('heroicon-o-home')
                                ->placeholder('Data tidak tersedia'),
                        ]),

                        TextEntry::make('alamat_spesifik')
                            ->label('Alamat Spesifik')
                            ->icon('heroicon-o-map-pin')
                            ->placeholder('Alamat spesifik tidak diisi')
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextEntry::make('koordinat')
                                ->label('Koordinat GPS')
                                ->icon('heroicon-o-globe-alt')
                                ->placeholder('Koordinat tidak tersedia')
                                ->url(fn($state) => $state ? "https://maps.google.com/?q={$state}" : null)
                                ->openUrlInNewTab()
                                ->color('primary')
                                ->tooltip('Klik untuk buka di Google Maps'),

                            TextEntry::make('referral')
                                ->label('Kode Referral')
                                ->icon('heroicon-o-ticket')
                                ->placeholder('Tidak menggunakan referral')
                                ->badge()
                                ->color('gray'),
                        ]),
                    ])
                    ->columns(1),

                // Section Timeline/History (jika ada)
                Section::make('Informasi Sistem')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->label('Tanggal Pendaftaran')
                                ->dateTime('d M Y, H:i:s')
                                ->icon('heroicon-o-plus-circle')
                                ->color('success'),

                            TextEntry::make('updated_at')
                                ->label('Terakhir Diperbarui')
                                ->dateTime('d M Y, H:i:s')
                                ->icon('heroicon-o-pencil-square')
                                ->color('warning'),
                        ]),
                    ])
                    ->collapsible()
                    ->collapsed(true),

                // Section Quick Actions
                Section::make('Aksi Cepat')
                    ->icon('heroicon-o-bolt')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('whatsapp_link')
                                ->label('WhatsApp')
                                ->formatStateUsing(fn($record) => $record->phone ? 'Hubungi via WhatsApp' : 'Tidak ada nomor HP')
                                ->url(fn($record) => $record->phone ? "https://wa.me/62" . ltrim($record->phone, '0') : null)
                                ->openUrlInNewTab()
                                ->icon('heroicon-o-chat-bubble-left-right')
                                ->color('success')
                                ->weight(FontWeight::Bold),

                            TextEntry::make('maps_link')
                                ->label('Google Maps')
                                ->formatStateUsing(fn($record) => $record->koordinat ? 'Buka di Maps' : 'Tidak ada koordinat')
                                ->url(fn($record) => $record->koordinat ? "https://maps.google.com/?q={$record->koordinat}" : null)
                                ->openUrlInNewTab()
                                ->icon('heroicon-o-map')
                                ->color('primary')
                                ->weight(FontWeight::Bold),

                            TextEntry::make('email_link')
                                ->label('Email')
                                ->formatStateUsing(fn($record) => $record->email ? 'Kirim Email' : 'Tidak ada email')
                                ->url(fn($record) => $record->email ? "mailto:{$record->email}" : null)
                                ->icon('heroicon-o-envelope')
                                ->color('info')
                                ->weight(FontWeight::Bold),
                        ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
