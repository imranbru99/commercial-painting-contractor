<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class JobsByStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by Status';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $statuses = ['estimate', 'scheduled', 'in_progress', 'punch', 'completed', 'cancelled'];
        $counts = [];
        foreach ($statuses as $status) {
            $counts[] = Project::query()->where('status', $status)->count();
        }

        return [
            'datasets' => [[
                'label' => 'Jobs',
                'data' => $counts,
                'backgroundColor' => ['#94A3B8', '#F59E0B', '#0D9488', '#38BDF8', '#22C55E', '#EF4444'],
            ]],
            'labels' => ['Estimate', 'Scheduled', 'In Progress', 'Punch', 'Completed', 'Cancelled'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
