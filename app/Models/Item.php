<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'serial_number',
        'model',
        'value',
        'unit',
        'quantity',
        'minimal_quantity',
        'description',
        'picture',
        'datasheet',
        'category_id',
        'location_id',
        'manufacturer_id',
    ];

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->slug = Str::slug($item->name);
        });
    }
}
