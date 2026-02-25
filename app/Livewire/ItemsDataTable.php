<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemsDataTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public string $search = '';

    protected $listeners = ['refreshTable'];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function refreshTable(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::query()
            ->with(['category:id,name', 'location:id,name', 'manufacturer:id,name', 'unitRelation:id,name']);

        if ($this->search !== '') {
            $s = trim($this->search);

            $query->where(function ($q) use ($s) {
                $q->where('items.name', 'like', "%{$s}%")
                    ->orWhere('items.slug', 'like', "%{$s}%")
                    ->orWhere('items.serial_number', 'like', "%{$s}%")
                    ->orWhere('items.model', 'like', "%{$s}%")
                    ->orWhereHas('category', fn($cq) => $cq->where('name', 'like', "%{$s}%"))
                    ->orWhereHas('location', fn($lq) => $lq->where('name', 'like', "%{$s}%"))
                    ->orWhereHas('manufacturer', fn($mq) => $mq->where('name', 'like', "%{$s}%"));
            });
        }

        $items = $query
            ->orderBy('items.name')
            ->paginate(10);

        return view('livewire.items-data-table', [
            'items' => $items,
        ]);
    }
}
