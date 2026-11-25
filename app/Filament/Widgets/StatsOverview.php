<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $openJobs = Project::query()->whereIn('status', ['estimate', 'scheduled', 'in_progress', 'punch'])->count();
        $pipeline = Project::query()->whereIn('status', ['estimate', 'scheduled', 'in_progress'])->sum('estimated_value');
        $receivables = Invoice::query()->whereIn('status', ['sent', 'partial', 'overdue'])->get()
            ->sum(fn (Invoice $i) => $i->balanceDue());
        $upcoming = Appointment::query()->where('starts_at', '>=', now())->where('status', 'scheduled')->count();

        return [
            Stat::make('Open Jobs', (string) $openJobs)
                ->description('Active commercial coating jobs')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),
            Stat::make('Pipeline Value', '$'.number_format((float) $pipeline, 0))
                ->description('Estimated job value')
                ->color('warning'),
            Stat::make('Receivables', '$'.number_format((float) $receivables, 0))
                ->description('Outstanding invoice balances')
                ->color('danger'),
            Stat::make('Customers', (string) Customer::count())
                ->description($upcoming.' upcoming site walks')
                ->color('success'),
        ];
    }
}
