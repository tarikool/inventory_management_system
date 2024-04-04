<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Inventory $inventory)
    {
        $items = Item::when($request->search, function ($q, $v) {
            $q->where('name', 'like', "%$v%")
                ->orWhere('description', 'like', "%$v%");
        })
            ->where('inventory_id', $inventory->id)
            ->whereHas('inventory', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest('created_at')
            ->get();

        foreach ($items as $key => $item) {
            $items[$key]->image = asset('storage/' . $item->image);
        }

        return Inertia::render('Item/Index', [
            'inventory' => $inventory,
            'items' => $items,
            'search' => $request->search
        ]);
    }


    public function create(Inventory $inventory)
    {
        return Inertia::render('Item/Create', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Inventory $inventory, Item $item)
    {
        $item->inventory_id = $inventory->id;
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->description = $request->description;
        $item->image = $request->image->store('items');
        $item->save();

        return Response::json(['message' => 'Item added successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }


    public function edit(Inventory $inventory, Item $item)
    {
        return Inertia::render('Item/Edit', [
            'inventory' => $inventory,
            'item' => $item
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Inventory $inventory, Item $item)
    {
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->description = $request->description;

        if ($request->image) {
            $item->image = $request->image->store('items');
        }

        $item->save();

        return Response::json(['message' => 'Item updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory, Item $item)
    {
        $item->delete();

        return Response::json(['message' => 'Item has been deleted']);
    }
}
