<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('item');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', "unique:items,slug,$id"],
            'serial_number' => ['nullable', 'string', 'max:255', "unique:items,serial_number,$id"],
            'model' => ['nullable', 'string', 'max:255'],

            'value' => ['nullable', 'numeric'],
            'unit' => ['nullable', 'string', 'max:50'],

            'quantity' => ['sometimes', 'required', 'integer', 'min:0'],
            'minimal_quantity' => ['sometimes', 'required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],

            'picture' => ['nullable', 'string', 'max:255'],
            'datasheet' => ['nullable', 'string', 'max:255'],

            'unit_id' => ['nullable', 'integer', 'exists:units,id'],
            'category_id' => ['sometimes', 'required', 'integer', 'exists:categories,id'],
            'location_id' => ['sometimes', 'required', 'integer', 'exists:locations,id'],
            'manufacturer_id' => ['nullable', 'integer', 'exists:manufacturers,id'],
        ];
    }
}
