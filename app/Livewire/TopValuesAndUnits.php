<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopValuesAndUnits extends Component
{
    public int $limit = 5;

    public function render()
    {
        $top = Item::query()
            ->leftJoin('units', 'units.id', '=', 'items.unit_id')
            ->whereNotNull('items.value')
            ->selectRaw("
                items.value as spec_value,
                COALESCE(units.name, items.unit, '') as spec_unit,
                SUM(items.quantity) as total_pcs
            ")
            ->groupBy('spec_value', 'spec_unit')
            ->orderByDesc('total_pcs')
            ->limit($this->limit)
            ->get();

        return view('livewire.top-values-and-units', [
            'top' => $top,
        ]);
    }
}
