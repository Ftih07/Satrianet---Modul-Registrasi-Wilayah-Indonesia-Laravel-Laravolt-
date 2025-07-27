<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBanner extends ViewRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Banner')
                ->icon('heroicon-o-pencil')
                ->color('warning'),
        ];
    }

    public function getTitle(): string
    {
        return "Detail Banner: {$this->record->title}";
    }
}
