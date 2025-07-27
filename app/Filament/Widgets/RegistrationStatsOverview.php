<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

/**
 * Stats overview for registration data.
 */
class RegistrationStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Registrations', Registration::count())
                ->description('All users registered')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Card::make('Pending', Registration::where('status', 'pending')->count())
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Card::make('Approved', Registration::where('status', 'approved')->count())
                ->description('Approved registrations')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
