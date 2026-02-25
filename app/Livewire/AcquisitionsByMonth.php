<?php

namespace App\Livewire;

use App\Models\Inventory;
use Carbon\Carbon;
use Livewire\Component;

class AcquisitionsByMonth extends Component
{
    public int $rangeDays = 90;

    public array $chart = [
        'labels' => [],
        'data' => [],
    ];

    public array $stats = [
        'this_month' => 0,
        'last_month' => 0,
        'avg_per_month' => 0,
    ];

    public function mount(): void
    {
        $this->loadData();
    }

    public function setRange(int $days): void
    {
        $this->rangeDays = $days;
        $this->loadData();
    }

    private function loadData(): void
    {
        $end = Carbon::today();
        $start = Carbon::today()->subDays($this->rangeDays)->startOfDay();

        $rows = Inventory::query()
            ->whereBetween('bought', [$start->toDateString(), $end->toDateString()])
            ->selectRaw("DATE_FORMAT(bought, '%Y-%m') as ym, COUNT(*) as cnt")
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        $labels = [];
        $data = [];

        foreach ($rows as $row) {
            $labels[] = Carbon::createFromFormat('Y-m', $row->ym)->format('M Y');
            $data[] = (int) $row->cnt;
        }

        $this->chart = [
            'labels' => $labels,
            'data' => $data,
        ];

        $thisMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonthNoOverflow()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonthNoOverflow()->endOfMonth();

        $this->stats['this_month'] = (int) Inventory::query()
            ->whereBetween('bought', [$thisMonthStart->toDateString(), $end->toDateString()])
            ->count();

        $this->stats['last_month'] = (int) Inventory::query()
            ->whereBetween('bought', [$lastMonthStart->toDateString(), $lastMonthEnd->toDateString()])
            ->count();

        $monthsCount = max(1, $start->diffInMonths($end) + 1);
        $sum = array_sum($data);
        $this->stats['avg_per_month'] = (int) round($sum / $monthsCount);

        $this->dispatch('acquisitions-chart:update', payload: $this->chart);
    }

    public function render()
    {
        return view('livewire.acquisitions-by-month');
    }
}
