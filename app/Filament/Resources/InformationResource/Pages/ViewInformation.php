<?php

namespace App\Filament\Resources\InformationResource\Pages;

use App\Filament\Resources\InformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInformation extends ViewRecord
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Preview Konten')
                ->icon('heroicon-o-eye')
                ->color('success')
                ->modalHeading(fn() => 'Preview: ' . $this->record->title)
                ->modalContent(fn() => view('filament.components.information-preview', ['record' => $this->record]))
                ->modalWidth('7xl')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup'),

            Actions\EditAction::make()
                ->label('Edit Informasi')
                ->icon('heroicon-o-pencil')
                ->color('warning'),

            Actions\Action::make('duplicate')
                ->label('Duplikat')
                ->icon('heroicon-o-document-duplicate')
                ->color('info')
                ->action(function () {
                    $newRecord = $this->record->replicate();
                    $newRecord->title = $this->record->title . ' (Copy)';
                    $newRecord->slug = $this->record->slug . '-copy-' . time();
                    $newRecord->status = false; // Set as draft
                    $newRecord->save();

                    $this->redirect(InformationResource::getUrl('edit', ['record' => $newRecord]));
                })
                ->requiresConfirmation()
                ->modalHeading('Duplikat Informasi')
                ->modalDescription('Apakah Anda yakin ingin menduplikat informasi ini? Duplikat akan dibuat sebagai draft.')
                ->modalSubmitActionLabel('Ya, Duplikat'),

            Actions\DeleteAction::make()
                ->label('Hapus Informasi')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->modalHeading('Hapus Informasi')
                ->modalDescription('Apakah Anda yakin ingin menghapus informasi ini? Data yang sudah dihapus tidak dapat dikembalikan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->successRedirectUrl(route('filament.admin.resources.information.index')),
        ];
    }

    public function getTitle(): string
    {
        return "Detail Informasi: {$this->record->title}";
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // InformationResource\Widgets\InformationStatsWidget::class,
        ];
    }
}
