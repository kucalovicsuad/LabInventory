<?php

namespace App\Livewire;

use App\Models\Log;
use Livewire\Component;

class RecentActivity extends Component
{
    public int $limit = 6;

    public function render()
    {
        $logs = Log::query()
            ->with([
                'user:id,first_name,last_name',
                'item:id,name',
            ])
            ->latest()
            ->limit($this->limit)
            ->get();

        return view('livewire.recent-activity', [
            'logs' => $logs,
        ]);
    }
}
