<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class ItemManagement extends Component
{
    use WireUiActions;
    use WithFileUploads;

    public $item = null;

    public $name;
    public $slug;
    public $serial_number;
    public $model;
    public $value;
    public $quantity;
    public $minimal_quantity;
    public $description;

    public $unit_id;
    public $category_id;
    public $location_id;
    public $manufacturer_id;

    public $picture;
    public $datasheet;

    public $picture_file;
    public $datasheet_file;

    public $created_at_display;
    public $updated_at_display;

    public $showModal = false;

    public $listeners = ['openItemModal', 'confirmedDeleteItem'];

    public function openItemModal($item_id = null)
    {
        $this->reset([
            'name',
            'slug',
            'serial_number',
            'model',
            'value',
            'quantity',
            'minimal_quantity',
            'description',
            'unit_id',
            'category_id',
            'location_id',
            'manufacturer_id',
            'picture',
            'datasheet',
            'picture_file',
            'datasheet_file',
            'created_at_display',
            'updated_at_display',
        ]);

        $this->item = $item_id ? Item::findOrFail($item_id) : null;

        if ($this->item) {
            $this->name             = $this->item->name;
            $this->slug             = $this->item->slug;
            $this->serial_number    = $this->item->serial_number;
            $this->model            = $this->item->model;
            $this->value            = $this->item->value;
            $this->quantity         = $this->item->quantity;
            $this->minimal_quantity = $this->item->minimal_quantity;
            $this->description      = $this->item->description;

            $this->unit_id          = $this->item->unit_id;
            $this->category_id      = $this->item->category_id;
            $this->location_id      = $this->item->location_id;
            $this->manufacturer_id  = $this->item->manufacturer_id;

            $this->picture          = $this->item->picture;
            $this->datasheet        = $this->item->datasheet;

            $this->created_at_display = Carbon::parse($this->item->created_at)->format('d.m.Y \a\t H:i');
            $this->updated_at_display = Carbon::parse($this->item->updated_at)->format('d.m.Y \a\t H:i');
        }

        $this->showModal = true;
    }

    public function updatedName($value)
    {
        if (!$this->item && blank($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function register()
    {
        $validated = $this->validate($this->rulesForCreate());

        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($this->picture_file) {
            $validated['picture'] = $this->picture_file->store('items/pictures', 'public');
        }

        if ($this->datasheet_file) {
            $validated['datasheet'] = $this->datasheet_file->store('items/datasheets', 'public');
        }

        Item::create($validated);

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Item added!',
            'description' => 'New item has been successfully added to the system.',
        ]);

        $this->reset('picture_file', 'datasheet_file', 'item');
        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    public function save()
    {
        if (!$this->item) return;

        $validated = $this->validate($this->rulesForUpdate());

        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $item = Item::findOrFail($this->item->id);

        if ($this->picture_file) {
            if ($item->picture && Storage::disk('public')->exists($item->picture)) {
                Storage::disk('public')->delete($item->picture);
            }
            $validated['picture'] = $this->picture_file->store('items/pictures', 'public');
        }

        if ($this->datasheet_file) {
            if ($item->datasheet && Storage::disk('public')->exists($item->datasheet)) {
                Storage::disk('public')->delete($item->datasheet);
            }
            $validated['datasheet'] = $this->datasheet_file->store('items/datasheets', 'public');
        }

        $item->update($validated);

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Item updated!',
            'description' => 'Item information has been successfully updated in the system.',
        ]);

        $this->reset('picture_file', 'datasheet_file');
        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    public function delete()
    {
        if (!$this->item) return;

        $this->dispatch(
            'openConfirmModal',
            "Obrisati stavku {$this->item->name}?",
            'confirmedDeleteItem',
            $this->item->id
        );
    }

    public function confirmedDeleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);

        if ($item->picture && Storage::disk('public')->exists($item->picture)) {
            Storage::disk('public')->delete($item->picture);
        }

        if ($item->datasheet && Storage::disk('public')->exists($item->datasheet)) {
            Storage::disk('public')->delete($item->datasheet);
        }

        $item->delete();

        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Item deleted!',
            'description' => 'Item has been successfully removed from the system.',
        ]);

        $this->reset('item');
        $this->showModal = false;
        $this->dispatch('refreshTable');
    }

    private function rulesForCreate(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:items,slug',
            'serial_number' => 'nullable|string|max:255|unique:items,serial_number',
            'model' => 'nullable|string|max:255',
            'value' => 'nullable|numeric',
            'quantity' => 'required|integer|min:0',
            'minimal_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'picture_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'datasheet_file' => 'nullable|file|mimes:pdf|max:20480',
            'unit_id' => 'nullable|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
        ];
    }

    private function rulesForUpdate(): array
    {
        $id = $this->item->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|unique:items,slug,{$id}",
            'serial_number' => "nullable|string|max:255|unique:items,serial_number,{$id}",
            'model' => 'nullable|string|max:255',
            'value' => 'nullable|numeric',
            'quantity' => 'required|integer|min:0',
            'minimal_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'picture_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'datasheet_file' => 'nullable|file|mimes:pdf|max:20480',
            'unit_id' => 'nullable|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
        ];
    }

    public function getUnitsProperty()
    {
        return Unit::orderBy('name')->get(['id', 'name']);
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get(['id', 'name']);
    }

    public function getLocationsProperty()
    {
        return Location::orderBy('name')->get(['id', 'name']);
    }

    public function getManufacturersProperty()
    {
        return Manufacturer::orderBy('name')->get(['id', 'name']);
    }

    public function render()
    {
        return view('livewire.item-management');
    }
}
