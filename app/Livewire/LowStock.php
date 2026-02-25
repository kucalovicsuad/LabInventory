<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class LowStock extends Component
{
    public int $limit = 4;

    public function render()
    {
        $items = Item::query()
            ->with(['location'])
            ->whereColumn('quantity', '<=', 'minimal_quantity')
            ->orderByRaw("CASE WHEN quantity = 0 THEN 0 ELSE 1 END")
            ->orderBy('quantity')
            ->limit($this->limit)
            ->get();

        return view('livewire.low-stock', [
            'items' => $items,
        ]);
    }
}
