<x-modal-card title="{{ $user ? 'Edit User' : 'Add New User' }}" name="cardModal" blur="base"
    wire:model.defer="showModal">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <x-input icon="user" label="First name" wire:model.defer="first_name" name="first_name" required autofocus />

        <x-input icon="user" label="Last name" wire:model.defer="last_name" name="last_name" required />

        <div class="col-span-1 sm:col-span-2">
            <x-input icon="at-symbol" label="Email address" wire:model.defer="email" name="email" required />
        </div>

        <div class="col-span-1 sm:col-span-2">
            <x-input icon="phone" label="Phone number" wire:model.defer="phone" name="phone" required />
        </div>

        @php
            $canEditRole = auth()->user()->role == 1;
        @endphp

        <span class="text-sm font-medium disabled:opacity-60 text-gray-700 dark:text-gray-400">
            User's role
        </span>

        <div
            class="col-span-1 sm:col-span-2 px-8 w-full flex flex-row items-center justify-between
           {{ !$canEditRole ? 'opacity-60 pointer-events-none' : '' }}">
            <x-radio label="Administrator" value="1" wire:model="role" :disabled="!$canEditRole" />
            <x-radio label="Laborant" value="2" wire:model="role" :disabled="!$canEditRole" />
            <x-radio label="Read Only" value="3" wire:model="role" :disabled="!$canEditRole" />
        </div>


        @if ($user)
            <div class="col-span-1 sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <x-input label="Created at" :value="$created_at_display" disabled />

                <x-input label="Last updated" :value="$updated_at_display" disabled />
            </div>
        @endif

    </div>

    <x-slot name="footer" class="flex justify-between gap-x-4">
        @if ($user)
            <x-button flat negative label="Delete" wire:click="delete" />
        @else
            <div></div>
        @endif

        <div class="flex gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />

            <x-button primary label="{{ $user ? 'Save' : 'Register' }}" wire:click="{{ $user ? 'save' : 'register' }}"
                wire:dirty.class.remove="opacity-50 cursor-not-allowed" class="opacity-50 cursor-not-allowed" />
        </div>
    </x-slot>
</x-modal-card>
