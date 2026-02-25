<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopCategories extends Component
{
    public int $limit = 5;

    public function render()
    {
        $rows = Category::query()
            ->leftJoin('items', 'items.category_id', '=', 'categories.id')
            ->select([
                'categories.id',
                'categories.name',
                DB::raw('COUNT(items.id) as items_count'),
                DB::raw('COALESCE(SUM(items.quantity), 0) as total_qty'),
            ])
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('items_count')
            ->orderByDesc('total_qty')
            ->limit($this->limit)
            ->get();

        $max = (int) ($rows->max('items_count') ?: 1);

        $rows = $rows->map(function ($row) use ($max) {
            $row->percent = (int) round(((int) $row->items_count / $max) * 100);
            return $row;
        });

        return view('livewire.top-categories', [
            'categories' => $rows,
        ]);
    }
}
