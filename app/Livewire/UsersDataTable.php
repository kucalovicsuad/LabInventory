<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UsersDataTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';

    protected $listeners = ['refreshTable'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function refreshTable()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                    ->orWhere('last_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        $users = $query
            ->orderBy('first_name')
            ->paginate(10)
            ->through(function ($user) {
                $lastActivity = DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->orderByDesc('last_activity')
                    ->value('last_activity');

                if ($lastActivity) {
                    $lastActivityCarbon = Carbon::createFromTimestamp($lastActivity);
                    $user->last_activity =
                        $lastActivityCarbon->diffInSeconds(now()) < 300
                        ? 'Active'
                        : $lastActivityCarbon->diffForHumans();
                } else {
                    $user->last_activity = 'Never';
                }

                return $user;
            });

        return view('livewire.users-data-table', [
            'users' => $users,
        ]);
    }
}
