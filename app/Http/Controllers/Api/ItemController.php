<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $q = Item::query();

        if ($search = $request->query('search')) {
            $q->where(function ($x) use ($search) {
                $x->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        return ItemResource::collection(
            $q->orderBy('name')->paginate(10)
        );
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());
        return (new ItemResource($item))->response()->setStatusCode(201);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());
        return new ItemResource($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
