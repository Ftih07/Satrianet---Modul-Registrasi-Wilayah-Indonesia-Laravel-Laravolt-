<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Enhanced bar chart widget to display comprehensive popular pages analytics.
 * Features include time period filters, better URL formatting, and detailed metrics.
 */
class PopularPagesChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Most Popular Pages';
    protected static string $color = 'success';
    protected static ?string $pollingInterval = '5m'; // Refresh every 5 minutes

    protected static ?string $maxHeight = '400px';

    public ?string $filter = '7_days';

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getData(): array
    {
        $period = $this->getPeriodFromFilter();
        $pageData = $this->getPopularPagesData($period);

        if ($pageData->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Page Views',
                        'data' => [],
                        'backgroundColor' => [],
                        'borderColor' => [],
                        'borderWidth' => 0,
                    ],
                ],
                'labels' => [],
            ];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Page Views',
                    'data' => $pageData->pluck('total')->toArray(),
                    'backgroundColor' => $this->getGradientColors($pageData->count()),
                    'borderColor' => $this->getBorderColors($pageData->count()),
                    'borderWidth' => 2,
                    'borderRadius' => 6,
                    'borderSkipped' => false,
                    'hoverBackgroundColor' => $this->getHoverColors($pageData->count()),
                    'hoverBorderColor' => $this->getHoverBorderColors($pageData->count()),
                    'hoverBorderWidth' => 3,
                ],
            ],
            'labels' => $pageData->pluck('formatted_url')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y', // Horizontal bar chart for better URL readability
            'plugins' => [
                'legend' => [
                    'display' => false, // Hide legend for cleaner look
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.9)',
                    'titleColor' => 'rgb(255, 255, 255)',
                    'bodyColor' => 'rgb(255, 255, 255)',
                    'borderColor' => 'rgba(255, 255, 255, 0.1)',
                    'borderWidth' => 1,
                    'cornerRadius' => 8,
                    'displayColors' => true,
                    'callbacks' => [
                        'title' => 'function(context) {
                            return context[0].label;
                        }',
                        'label' => 'function(context) {
                            const percentage = ((context.parsed.x / context.dataset.data.reduce((a, b) => a + b, 0)) * 100).toFixed(1);
                            return context.parsed.x.toLocaleString() + " views (" + percentage + "%)";
                        }',
                        'afterLabel' => 'function(context) {
                            const totalViews = context.dataset.data.reduce((a, b) => a + b, 0);
                            const avgViews = Math.round(totalViews / context.dataset.data.length);
                            const current = context.parsed.x;
                            if (current > avgViews) {
                                return "📈 Above average (" + avgViews.toLocaleString() + ")";
                            } else {
                                return "📊 Below average (" + avgViews.toLocaleString() + ")";
                            }
                        }',
                    ],
                ],
            ],
            'scales' => [
                'x' => [
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
                        'color' => 'rgba(0, 0, 0, 0.08)',
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
                'y' => [
                    'display' => true,
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'font' => [
                            'family' => 'Inter, sans-serif',
                            'size' => 11,
                            'weight' => '500',
                        ],
                        'color' => 'rgb(75, 85, 99)',
                        'maxTicksLimit' => 10,
                    ],
                ],
            ],
            'interaction' => [
                'intersect' => false,
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'layout' => [
                'padding' => [
                    'top' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'right' => 10,
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            '7_days' => 'Last 7 Days',
            '30_days' => 'Last 30 Days',
            '90_days' => 'Last 3 Months',
        ];
    }

    private function getPeriodFromFilter(): int
    {
        return match ($this->filter) {
            'today' => 1,
            '7_days' => 7,
            '30_days' => 30,
            '90_days' => 90,
            default => 7,
        };
    }

    private function getPopularPagesData(int $days): \Illuminate\Support\Collection
    {
        $startDate = $this->filter === 'today'
            ? Carbon::today()
            : Carbon::now()->subDays($days - 1)->startOfDay();

        $query = PageView::select('url', DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $startDate)
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(10);

        $data = $query->get();

        // Format URLs for better display
        return $data->map(function ($item) {
            $item->formatted_url = $this->formatUrl($item->url);
            return $item;
        });
    }

    private function formatUrl(string $url): string
    {
        // Remove protocol and domain
        $path = parse_url($url, PHP_URL_PATH) ?? $url;

        // Remove leading slash
        $path = ltrim($path, '/');

        // If empty, it's homepage
        if (empty($path)) {
            return '🏠 Homepage';
        }

        // Convert path to readable format
        $segments = explode('/', $path);
        $readable = collect($segments)
            ->map(function ($segment) {
                // Convert kebab-case and snake_case to Title Case
                return Str::title(str_replace(['-', '_'], ' ', $segment));
            })
            ->filter()
            ->take(3) // Limit to 3 segments for readability
            ->join(' › ');

        // Add appropriate emoji based on path
        $emoji = $this->getPageEmoji($path);

        // Limit length for display
        if (strlen($readable) > 40) {
            $readable = substr($readable, 0, 37) . '...';
        }

        return $emoji . ' ' . $readable;
    }

    private function getPageEmoji(string $path): string
    {
        $path = strtolower($path);

        if (str_contains($path, 'blog') || str_contains($path, 'article')) return '📝';
        if (str_contains($path, 'product')) return '🛍️';
        if (str_contains($path, 'category')) return '📂';
        if (str_contains($path, 'about')) return 'ℹ️';
        if (str_contains($path, 'contact')) return '📞';
        if (str_contains($path, 'admin') || str_contains($path, 'dashboard')) return '⚙️';
        if (str_contains($path, 'user') || str_contains($path, 'profile')) return '👤';
        if (str_contains($path, 'search')) return '🔍';
        if (str_contains($path, 'cart') || str_contains($path, 'checkout')) return '🛒';
        if (str_contains($path, 'login') || str_contains($path, 'register')) return '🔐';

        return '📄';
    }

    private function getGradientColors(int $count): array
    {
        $baseColors = [
            'rgba(59, 130, 246, 0.8)',   // Blue
            'rgba(16, 185, 129, 0.8)',   // Green
            'rgba(245, 158, 11, 0.8)',   // Yellow
            'rgba(239, 68, 68, 0.8)',    // Red
            'rgba(139, 92, 246, 0.8)',   // Purple
            'rgba(236, 72, 153, 0.8)',   // Pink
            'rgba(6, 182, 212, 0.8)',    // Cyan
            'rgba(34, 197, 94, 0.8)',    // Emerald
            'rgba(251, 146, 60, 0.8)',   // Orange
            'rgba(168, 85, 247, 0.8)',   // Violet
        ];

        return array_slice($baseColors, 0, $count);
    }

    private function getBorderColors(int $count): array
    {
        $borderColors = [
            'rgb(59, 130, 246)',   // Blue
            'rgb(16, 185, 129)',   // Green
            'rgb(245, 158, 11)',   // Yellow
            'rgb(239, 68, 68)',    // Red
            'rgb(139, 92, 246)',   // Purple
            'rgb(236, 72, 153)',   // Pink
            'rgb(6, 182, 212)',    // Cyan
            'rgb(34, 197, 94)',    // Emerald
            'rgb(251, 146, 60)',   // Orange
            'rgb(168, 85, 247)',   // Violet
        ];

        return array_slice($borderColors, 0, $count);
    }

    private function getHoverColors(int $count): array
    {
        $hoverColors = [
            'rgba(59, 130, 246, 0.9)',
            'rgba(16, 185, 129, 0.9)',
            'rgba(245, 158, 11, 0.9)',
            'rgba(239, 68, 68, 0.9)',
            'rgba(139, 92, 246, 0.9)',
            'rgba(236, 72, 153, 0.9)',
            'rgba(6, 182, 212, 0.9)',
            'rgba(34, 197, 94, 0.9)',
            'rgba(251, 146, 60, 0.9)',
            'rgba(168, 85, 247, 0.9)',
        ];

        return array_slice($hoverColors, 0, $count);
    }

    private function getHoverBorderColors(int $count): array
    {
        return $this->getBorderColors($count);
    }

    public static function canView(): bool
    {
        return true;
    }
}
