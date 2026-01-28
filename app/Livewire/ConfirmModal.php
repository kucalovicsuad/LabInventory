<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmModal extends Component
{
    public $show = false;
    public $message = '';
    public $confirmAction;
    public $confirmPayload;

    protected $listeners = ['openConfirmModal'];

    public function openConfirmModal($message, $action, $payload = null)
    {
        $this->message = $message;
        $this->confirmAction = $action;
        $this->confirmPayload = $payload;
        $this->show = true;
    }

    public function confirm()
    {
        $this->dispatch($this->confirmAction, $this->confirmPayload);
        $this->show = false;
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.confirm-modal');
    }
}
