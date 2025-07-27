<?php

namespace App\Filament\Resources\CategoryInformationResource\Pages;

use App\Filament\Resources\CategoryInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryInformation extends ListRecords
{
    protected static string $resource = CategoryInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
