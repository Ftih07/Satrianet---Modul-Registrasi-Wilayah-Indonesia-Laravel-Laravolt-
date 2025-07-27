<?php

namespace App\Filament\Resources\CategoryInformationResource\Pages;

use App\Filament\Resources\CategoryInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryInformation extends EditRecord
{
    protected static string $resource = CategoryInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
