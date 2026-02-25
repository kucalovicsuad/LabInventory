<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmModal extends Component
{
    public $show = false;
    public $message = '';
    public $confirmAction;
    public $confirmPayload;
    public $confirmTarget;

    protected $listeners = ['openConfirmModal'];

    public function openConfirmModal($message, $action, $payload = null, $target = null)
    {
        $this->message = $message;
        $this->confirmAction = $action;
        $this->confirmPayload = $payload;
        $this->confirmTarget = $target;
        $this->show = true;
    }

    public function confirm()
    {
        if ($this->confirmTarget) {
            $this->dispatch($this->confirmAction, $this->confirmPayload)
                ->to($this->confirmTarget);
        } else {
            $this->dispatch($this->confirmAction, $this->confirmPayload);
        }

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
