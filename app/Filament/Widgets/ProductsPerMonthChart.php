<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

/**
 * Chart widget to display the number of products created per month.
 */
class ProductsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Products Created Per Month';

    protected function getData(): array
    {
        $data = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $data->values(),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $data->keys()->map(function ($month) {
                return date('F', mktime(0, 0, 0, $month, 1));
            }),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa 'line', 'bar', 'pie', dll
    }
}
