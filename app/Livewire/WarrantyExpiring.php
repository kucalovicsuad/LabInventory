<?php

namespace App\Livewire;

use App\Models\Inventory;
use Carbon\Carbon;
use Livewire\Component;

class WarrantyExpiring extends Component
{
    public int $daysAhead = 90;
    public int $limit = 6;

    public function render()
    {
        $today = Carbon::today();
        $until = Carbon::today()->addDays($this->daysAhead);

        $inventories = Inventory::query()
            ->with('item')
            ->whereNotNull('warranty')
            ->select('*')
            ->selectRaw('DATE_ADD(bought, INTERVAL warranty MONTH) as expires_at')
            ->havingRaw('expires_at BETWEEN ? AND ?', [
                $today->toDateString(),
                $until->toDateString()
            ])
            ->orderBy('expires_at')
            ->limit($this->limit)
            ->get();

        return view('livewire.warranty-expiring', [
            'inventories' => $inventories,
        ]);
    }
}
