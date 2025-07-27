<?php

namespace App\Filament\Widgets;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\Product;
use App\Models\Information;
use App\Models\Banner;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

/**
 * Dashboard widget to display statistics for products, categories, information, and banners.
 */
class ContentStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s'; // Auto-refresh every 30 seconds

    protected function getCards(): array
    {
        return [
            Card::make('Product Categories', ProductCategory::count())
                ->description('Total categories available')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success'),

            Card::make('Product Subcategories', ProductSubcategory::count())
                ->description('Total subcategories')
                ->descriptionIcon('heroicon-m-list-bullet')
                ->color('info'),

            Card::make('Products', Product::count())
                ->description('Total products listed')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Card::make('Information', Information::count())
                ->description('Total information posts')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Card::make('Banners', Banner::count())
                ->description('Total banners')
                ->descriptionIcon('heroicon-m-photo')
                ->color('danger'),
        ];
    }
}
