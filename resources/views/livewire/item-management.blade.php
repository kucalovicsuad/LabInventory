<x-modal-card title="{{ $item ? 'Edit Item' : 'Add New Item' }}" name="itemModal" blur="base"
    wire:model.defer="showModal">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <x-input label="Name" wire:model.defer="name" required />
        <x-input label="Slug" wire:model.defer="slug" required />
        <x-input label="Serial number" wire:model.defer="serial_number" />
        <x-input label="Model" wire:model.defer="model" />

        <div class="col-span-1 sm:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <x-input label="Value" wire:model.defer="value" type="number" step="0.01" />
            </div>
            <div>
                <x-select label="Unit" wire:model.defer="unit_id" :options="$this->units" option-label="name"
                    option-value="id" required />
            </div>
        </div>

        <x-input label="Quantity" wire:model.defer="quantity" type="number" required />
        <x-input label="Minimal quantity" wire:model.defer="minimal_quantity" type="number" required />

        <div class="col-span-1 sm:col-span-2">
            <x-textarea label="Description" wire:model.defer="description" />
        </div>

        <div class="col-span-1 sm:col-span-2">
            @php
                $defaultImg = asset('images/item-default.png');
                $currentImg = $item && $item->picture ? asset('storage/' . $item->picture) : $defaultImg;
            @endphp

            <div class="flex items-start gap-4">
                <img src="{{ $picture_file ? $picture_file->temporaryUrl() : $currentImg }}"
                    class="h-20 w-20 rounded object-cover border"
                    onerror="this.onerror=null;this.src='{{ $defaultImg }}';">
                <div class="flex-1">
                    <input type="file" wire:model="picture_file" accept="image/*" class="block w-full">
                    @error('picture_file')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-span-1 sm:col-span-2">
            <input type="file" wire:model="datasheet_file" accept="application/pdf" class="block w-full">
            @error('datasheet_file')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror

            @if ($item && $item->datasheet)
                <a class="text-blue-600 underline text-sm" target="_blank"
                    href="{{ asset('storage/' . $item->datasheet) }}">
                    Open datasheet
                </a>
            @endif
        </div>

        <x-select label="Manufacturer" wire:model.defer="manufacturer_id" :options="$this->manufacturers" option-label="name"
            option-value="id" clearable />

        <x-select label="Category" wire:model.defer="category_id" :options="$this->categories" option-label="name"
            option-value="id" required />

        <x-select label="Location" wire:model.defer="location_id" :options="$this->locations" option-label="name"
            option-value="id" required />

        @if ($item)
            <div class="col-span-1 sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <x-input label="Created at" :value="$created_at_display" disabled />
                <x-input label="Last updated" :value="$updated_at_display" disabled />
            </div>
        @endif
    </div>

    <x-slot name="footer" class="flex justify-between gap-x-4">
        @if ($item)
            <x-button flat negative label="Delete" wire:click="delete" />
        @else
            <div></div>
        @endif

        <div class="flex gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />
            <x-button primary label="{{ $item ? 'Save' : 'Register' }}"
                wire:click="{{ $item ? 'save' : 'register' }}" />
        </div>
    </x-slot>
</x-modal-card>
