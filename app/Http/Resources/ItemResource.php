<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'serial_number' => $this->serial_number,
            'model' => $this->model,

            'value' => $this->value,
            'unit' => $this->unit,
            'unit_id' => $this->unit_id,

            'quantity' => $this->quantity,
            'minimal_quantity' => $this->minimal_quantity,
            'description' => $this->description,

            'picture' => $this->picture,
            'datasheet' => $this->datasheet,

            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'manufacturer_id' => $this->manufacturer_id,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
