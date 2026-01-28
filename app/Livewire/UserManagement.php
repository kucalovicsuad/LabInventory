<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class UserManagement extends Component
{
    use WireUiActions;
    public $user = null;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $role = 3;
    public $showModal = false;
    public $listeners = ['openModal', 'confirmedDelete'];

    public function openModal($user_id = null)
    {
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'role']);

        $this->user = $user_id ? User::findOrFail($user_id) : null;

        $this->first_name = $this->user ? $this->user->first_name : null;
        $this->last_name = $this->user ? $this->user->last_name : null;;
        $this->email = $this->user ? $this->user->email : null;;
        $this->phone = $this->user ? $this->user->phone : null;;
        $this->role = $this->user ? $this->user->role : 3;

        $this->showModal = true;
    }

    public function register()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:1,2,3',
        ]);

        User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => $validatedData['role'],
            'password' => bcrypt('pass1234'),
        ]);

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'User added!',
            'description' => 'New user has been successfully added to the system.',
        ]);

        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    public function save()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'phone' => 'required|string|max:20',
            'role' => 'required|in:1,2,3',
        ]);

        $user = User::find($this->user->id);
        $user->update($validatedData);

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'User information updated!',
            'description' => 'User information has been successfully updated in the system.',
        ]);

        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    public function delete()
    {
        $this->dispatch(
            'openConfirmModal',
            "Obrisati korisnika {$this->user->first_name} {$this->user->last_name}?",
            'confirmedDelete',
            $this->user->id
        );
    }

    public function confirmedDelete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'User deleted!',
            'description' => 'User has been successfully removed from the system.',
        ]);

        $this->reset('user');
        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.user-management');
    }
}
