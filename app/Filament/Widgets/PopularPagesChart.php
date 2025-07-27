<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

/**
 * Bar chart widget to display most visited pages.
 */
class PopularPagesChart extends ChartWidget
{
    protected static ?string $heading = 'Most Visited Pages';

    protected function getData(): array
    {
        $data = PageView::selectRaw('url, COUNT(*) as total')
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'url');

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $data->values(),
                    'backgroundColor' => ['#3b82f6', '#06b6d4', '#f59e0b', '#10b981', '#ef4444'],
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
