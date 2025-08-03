<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Enhanced line chart widget to display comprehensive website traffic analytics.
 * Features include multiple metrics, better styling, and interactive elements.
 */
class DailyTrafficChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Website Traffic Analytics';
    protected static string $color = 'info';
    protected static ?string $pollingInterval = '60s'; // Refresh every minute

    // Make the chart taller for better visibility
    protected static ?string $maxHeight = '300px';

    // Add filter for time periods
    public ?string $filter = '14_days';

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getData(): array
    {
        $period = $this->getPeriodFromFilter();
        $trafficData = $this->getTrafficData($period);
        $uniqueVisitorData = $this->getUniqueVisitorData($period);

        return [
            'datasets' => [
                [
                    'label' => 'Total Page Views',
                    'data' => $trafficData->values()->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => 'origin',
                    'tension' => 0.4,
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'pointBorderColor' => 'rgb(255, 255, 255)',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label' => 'Unique Visitors',
                    'data' => $uniqueVisitorData->values()->toArray(),
                    'borderColor' => 'rgb(16, 185, 129)',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => 'origin',
                    'tension' => 0.4,
                    'pointBackgroundColor' => 'rgb(16, 185, 129)',
                    'pointBorderColor' => 'rgb(255, 255, 255)',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $this->formatLabels($trafficData->keys()->toArray()),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 12,
                            'weight' => '500',
                        ],
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => 'rgb(255, 255, 255)',
                    'bodyColor' => 'rgb(255, 255, 255)',
                    'borderColor' => 'rgba(255, 255, 255, 0.1)',
                    'borderWidth' => 1,
                    'cornerRadius' => 8,
                    'displayColors' => true,
                    'callbacks' => [
                        'title' => 'function(context) {
                            return "Traffic for " + context[0].label;
                        }',
                        'label' => 'function(context) {
                            return context.dataset.label + ": " + context.parsed.y.toLocaleString() + " visits";
                        }',
                    ],
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Date',
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 12,
                            'weight' => '600',
                        ],
                    ],
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.05)',
                        'drawOnChartArea' => true,
                    ],
                    'ticks' => [
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 11,
                        ],
                        'maxTicksLimit' => 8,
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Views',
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 12,
                            'weight' => '600',
                        ],
                    ],
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.05)',
                        'drawOnChartArea' => true,
                    ],
                    'ticks' => [
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 11,
                        ],
                        'callback' => 'function(value) {
                            return value.toLocaleString();
                        }',
                    ],
                ],
            ],
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'elements' => [
                'line' => [
                    'borderWidth' => 3,
                ],
                'point' => [
                    'hoverBorderWidth' => 3,
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            '7_days' => 'Last 7 Days',
            '14_days' => 'Last 14 Days',
            '30_days' => 'Last 30 Days',
            '90_days' => 'Last 3 Months',
        ];
    }

    private function getPeriodFromFilter(): int
    {
        return match ($this->filter) {
            '7_days' => 7,
            '14_days' => 14,
            '30_days' => 30,
            '90_days' => 90,
            default => 14,
        };
    }

    private function getTrafficData(int $days): \Illuminate\Support\Collection
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $data = PageView::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // Fill missing dates with 0
        return $this->fillMissingDates($data, $days);
    }

    private function getUniqueVisitorData(int $days): \Illuminate\Support\Collection
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $data = PageView::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(DISTINCT ip_address) as unique_visitors')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('unique_visitors', 'date');

        return $this->fillMissingDates($data, $days);
    }

    private function fillMissingDates(\Illuminate\Support\Collection $data, int $days): \Illuminate\Support\Collection
    {
        $filledData = collect();

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $filledData[$date] = $data->get($date, 0);
        }

        return $filledData;
    }

    private function formatLabels(array $dates): array
    {
        return collect($dates)->map(function ($date) {
            $carbonDate = Carbon::parse($date);

            // Format based on filter period
            return match ($this->filter) {
                '7_days', '14_days' => $carbonDate->format('M j'), // "Jan 15"
                '30_days' => $carbonDate->format('M j'), // "Jan 15"
                '90_days' => $carbonDate->format('M j'), // "Jan 15"
                default => $carbonDate->format('M j'),
            };
        })->toArray();
    }

    public static function canView(): bool
    {
        return true;
    }
}
