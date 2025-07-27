<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

/**
 * Line chart widget to display daily traffic.
 */
class DailyTrafficChart extends ChartWidget
{
    protected static ?string $heading = 'Daily Website Traffic';

    protected function getData(): array
    {
        $data = PageView::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->limit(14) // 14 hari terakhir
            ->pluck('total', 'date');

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $data->values(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.3)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
