<?php

namespace App\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopLocations extends Component
{
    public int $limit = 5;

    public function render()
    {
        $rows = Location::query()
            ->leftJoin('items', 'items.location_id', '=', 'locations.id')
            ->select([
                'locations.id',
                'locations.name',
                DB::raw('COUNT(items.id) as items_count'),
                DB::raw('COALESCE(SUM(items.quantity), 0) as total_qty'),
            ])
            ->groupBy('locations.id', 'locations.name')
            ->orderByDesc('total_qty')
            ->orderByDesc('items_count')
            ->limit($this->limit)
            ->get();

        return view('livewire.top-locations', [
            'locations' => $rows,
        ]);
    }
}
