<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\Item;
use Livewire\Component;

class KpiCards extends Component
{
    public array $kpi = [];

    public function mount(): void
    {
        $this->loadKpi();
    }

    public function loadKpi(): void
    {
        $this->kpi = [
            'total_items' => Item::query()->count(),
            'total_quantity' => (int) Item::query()->sum('quantity'),
            'inventory_records' => Inventory::query()->count(),
            'items_with_value' => Item::query()->whereNotNull('value')->count(),
            'low_stock' => Item::query()
                ->whereColumn('quantity', '<=', 'minimal_quantity')
                ->count(),
            'out_of_stock' => Item::query()
                ->where('quantity', 0)
                ->count(),
        ];
    }
    public function render()
    {
        return view('livewire.kpi-cards');
    }
}
