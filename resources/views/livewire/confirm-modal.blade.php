<x-modal-card title="Confirm action" blur="base" wire:model.defer="show" align="center">
    <div class="text-sm text-gray-600 dark:text-gray-300">
        {{ $message }}
    </div>

    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <x-button flat label="No" wire:click="cancel" />

            <x-button negative label="Yes" wire:click="confirm" wire:loading.attr="disabled" />
        </div>
    </x-slot>
</x-modal-card>
