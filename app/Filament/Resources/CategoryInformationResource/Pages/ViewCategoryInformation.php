<?php

namespace App\Filament\Resources\CategoryInformationResource\Pages;

use App\Filament\Resources\CategoryInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryInformation extends ViewRecord
{
    protected static string $resource = CategoryInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Kategori')
                ->icon('heroicon-o-pencil')
                ->color('warning'),

            Actions\DeleteAction::make()
                ->label('Hapus Kategori')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Kategori')
                ->modalDescription('Apakah Anda yakin ingin menghapus kategori ini? Semua informasi yang terkait akan kehilangan kategorinya.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->successRedirectUrl(CategoryInformationResource::getUrl('index')),
        ];
    }

    public function getTitle(): string
    {
        return "Detail Kategori: {$this->record->title}";
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // CategoryInformationResource\Widgets\CategoryStatsWidget::class,
        ];
    }
}
