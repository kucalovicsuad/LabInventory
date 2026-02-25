<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class DataQuality extends Component
{
    public array $stats = [];

    public function mount(): void
    {
        $this->loadStats();
    }

    public function loadStats(): void
    {
        $this->stats = [
            'missing_datasheet' => Item::query()
                ->whereNull('datasheet')
                ->orWhere('datasheet', '')
                ->count(),

            'missing_picture' => Item::query()
                ->whereNull('picture')
                ->orWhere('picture', '')
                ->count(),

            'missing_serial' => Item::query()
                ->whereNull('serial_number')
                ->orWhere('serial_number', '')
                ->count(),

            'missing_manufacturer' => Item::query()
                ->whereNull('manufacturer_id')
                ->count(),
        ];
    }

    public function render()
    {
        return view('livewire.data-quality');
    }
}
