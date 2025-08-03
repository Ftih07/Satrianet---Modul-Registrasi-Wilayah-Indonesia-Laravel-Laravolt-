<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Enhanced stats overview for registration data with comprehensive analytics.
 * Features include trend analysis, conversion rates, and time-based insights.
 */
class RegistrationStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // Urutan pertama
    protected static ?string $pollingInterval = '60s'; // Auto-refresh every minute
    protected static bool $isLazy = false;

    // Make widget span full width for better layout
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $currentStats = $this->getCurrentStats();
        $previousStats = $this->getPreviousStats();
        $todayStats = $this->getTodayStats();

        return [
            $this->createTotalRegistrationsStat($currentStats, $previousStats),
            $this->createPendingStat($currentStats, $todayStats),
            $this->createApprovedStat($currentStats, $todayStats),
            $this->createRejectedStat($currentStats, $todayStats),
            $this->createConversionRateStat($currentStats),
            $this->createTodayRegistrationStat($todayStats),
        ];
    }

    private function getCurrentStats(): array
    {
        return [
            'total' => Registration::count(),
            'pending' => Registration::where('status', 'pending')->count(),
            'approved' => Registration::where('status', 'approved')->count(),
            'rejected' => Registration::where('status', 'rejected')->count(),
            'this_week' => Registration::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
            'this_month' => Registration::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
        ];
    }

    private function getPreviousStats(): array
    {
        $lastMonth = Carbon::now()->subMonth();

        return [
            'total' => Registration::where('created_at', '<=', $lastMonth)->count(),
            'approved' => Registration::where('status', 'approved')
                ->where('updated_at', '<=', $lastMonth)
                ->count(),
            'last_week' => Registration::whereBetween('created_at', [
                Carbon::now()->subWeek(2)->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])->count(),
            'last_month' => Registration::whereBetween('created_at', [
                Carbon::now()->subMonth(2)->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->count(),
        ];
    }

    private function getTodayStats(): array
    {
        $today = Carbon::today();

        return [
            'registrations' => Registration::whereDate('created_at', $today)->count(),
            'pending' => Registration::where('status', 'pending')
                ->whereDate('created_at', $today)
                ->count(),
            'approved' => Registration::where('status', 'approved')
                ->whereDate('updated_at', $today)
                ->count(),
            'rejected' => Registration::where('status', 'rejected')
                ->whereDate('updated_at', $today)
                ->count(),
        ];
    }

    private function createTotalRegistrationsStat(array $current, array $previous): Stat
    {
        $change = $current['total'] - $previous['total'];
        $changePercent = $previous['total'] > 0
            ? round(($change / $previous['total']) * 100, 1)
            : 0;

        return Stat::make('Total Registrations', number_format($current['total']))
            ->description($this->getChangeDescription($change, 'new registrations this month'))
            ->descriptionIcon($change >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
            ->chart($this->generateRegistrationTrendChart())
            ->color($change >= 0 ? 'success' : 'danger')
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20',
            ]);
    }

    private function createPendingStat(array $current, array $today): Stat
    {
        $pendingPercentage = $current['total'] > 0
            ? round(($current['pending'] / $current['total']) * 100, 1)
            : 0;

        $avgProcessingTime = $this->getAverageProcessingTime();

        return Stat::make('Pending Approvals', number_format($current['pending']))
            ->description("{$pendingPercentage}% of total • {$today['pending']} new today")
            ->descriptionIcon('heroicon-m-clock')
            ->chart($this->generatePendingTrendChart())
            ->color($pendingPercentage > 20 ? 'danger' : ($pendingPercentage > 10 ? 'warning' : 'info'))
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20',
            ]);
    }

    private function createApprovedStat(array $current, array $today): Stat
    {
        $approvalRate = $current['total'] > 0
            ? round(($current['approved'] / $current['total']) * 100, 1)
            : 0;

        return Stat::make('Approved', number_format($current['approved']))
            ->description("{$approvalRate}% approval rate • {$today['approved']} approved today")
            ->descriptionIcon('heroicon-m-check-circle')
            ->chart($this->generateApprovedTrendChart())
            ->color($approvalRate >= 80 ? 'success' : ($approvalRate >= 60 ? 'warning' : 'danger'))
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20',
            ]);
    }

    private function createRejectedStat(array $current, array $today): Stat
    {
        $rejectionRate = $current['total'] > 0
            ? round(($current['rejected'] / $current['total']) * 100, 1)
            : 0;

        return Stat::make('Rejected', number_format($current['rejected']))
            ->description("{$rejectionRate}% rejection rate • {$today['rejected']} rejected today")
            ->descriptionIcon('heroicon-m-x-circle')
            ->chart($this->generateRejectedTrendChart())
            ->color($rejectionRate <= 10 ? 'success' : ($rejectionRate <= 20 ? 'warning' : 'danger'))
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20',
            ]);
    }

    private function createConversionRateStat(array $current): Stat
    {
        $processedTotal = $current['approved'] + $current['rejected'];
        $conversionRate = $processedTotal > 0
            ? round(($current['approved'] / $processedTotal) * 100, 1)
            : 0;

        $weeklyGrowth = $this->getWeeklyGrowthRate();

        return Stat::make('Conversion Rate', "{$conversionRate}%")
            ->description($this->getGrowthDescription($weeklyGrowth, 'vs last week'))
            ->descriptionIcon($weeklyGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
            ->chart($this->generateConversionChart())
            ->color($conversionRate >= 80 ? 'success' : ($conversionRate >= 60 ? 'warning' : 'danger'))
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20',
            ]);
    }

    private function createTodayRegistrationStat(array $today): Stat
    {
        $yesterdayCount = Registration::whereDate('created_at', Carbon::yesterday())->count();
        $change = $today['registrations'] - $yesterdayCount;

        $avgDailyThisWeek = Registration::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()
        ])->count() / (Carbon::now()->dayOfWeek ?: 7);

        $performance = $today['registrations'] > $avgDailyThisWeek ? 'above' : 'below';
        $avgFormatted = number_format($avgDailyThisWeek, 1);

        return Stat::make('Today\'s Registrations', number_format($today['registrations']))
            ->description("{$performance} weekly avg ({$avgFormatted}) • " . $this->getChangeDescription($change, 'vs yesterday'))
            ->descriptionIcon($change >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
            ->chart($this->generateDailyTrendChart())
            ->color($change >= 0 ? 'success' : 'info')
            ->extraAttributes([
                'class' => 'bg-gradient-to-br from-cyan-50 to-teal-50 dark:from-cyan-900/20 dark:to-teal-900/20',
            ]);
    }

    private function getChangeDescription(int $change, string $context): string
    {
        if ($change > 0) {
            return "+{$change} {$context}";
        } elseif ($change < 0) {
            return abs($change) . " fewer {$context}";
        } else {
            return "No change {$context}";
        }
    }

    private function getGrowthDescription(float $growth, string $context): string
    {
        if ($growth > 0) {
            return "+{$growth}% {$context}";
        } elseif ($growth < 0) {
            return "{$growth}% {$context}";
        } else {
            return "No change {$context}";
        }
    }

    private function getAverageProcessingTime(): string
    {
        $avgHours = Registration::whereIn('status', ['approved', 'rejected'])
            ->whereNotNull('updated_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours')
            ->value('avg_hours');

        if (!$avgHours) {
            return 'N/A';
        }

        if ($avgHours < 24) {
            return round($avgHours, 1) . 'h';
        } else {
            return round($avgHours / 24, 1) . 'd';
        }
    }

    private function getWeeklyGrowthRate(): float
    {
        $thisWeek = Registration::where('created_at', '>=', Carbon::now()->startOfWeek())->count();
        $lastWeek = Registration::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->count();

        if ($lastWeek === 0) {
            return $thisWeek > 0 ? 100 : 0;
        }

        return round((($thisWeek - $lastWeek) / $lastWeek) * 100, 1);
    }

    private function generateRegistrationTrendChart(): array
    {
        return Registration::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray() ?: [0, 1, 2, 3, 2, 4, 3];
    }

    private function generatePendingTrendChart(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                return Registration::where('status', 'pending')
                    ->whereDate('created_at', Carbon::now()->subDays($daysAgo))
                    ->count();
            })
            ->toArray();
    }

    private function generateApprovedTrendChart(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                return Registration::where('status', 'approved')
                    ->whereDate('updated_at', Carbon::now()->subDays($daysAgo))
                    ->count();
            })
            ->toArray();
    }

    private function generateRejectedTrendChart(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                return Registration::where('status', 'rejected')
                    ->whereDate('updated_at', Carbon::now()->subDays($daysAgo))
                    ->count();
            })
            ->toArray();
    }

    private function generateConversionChart(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::now()->subDays($daysAgo);
                $approved = Registration::where('status', 'approved')
                    ->whereDate('updated_at', $date)
                    ->count();
                $total = Registration::whereIn('status', ['approved', 'rejected'])
                    ->whereDate('updated_at', $date)
                    ->count();

                return $total > 0 ? round(($approved / $total) * 100) : 0;
            })
            ->toArray();
    }

    private function generateDailyTrendChart(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                return Registration::whereDate('created_at', Carbon::now()->subDays($daysAgo))
                    ->count();
            })
            ->toArray();
    }

    public static function canView(): bool
    {
        return true;
    }
}
