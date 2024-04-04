<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inventory\UpdateInventoryRequest;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $inventories = Inventory::when($request->search, function ($q, $v) {
            $q->where('name', 'like', "%$v%")
                ->orWhere('description', 'like', "%$v%");
        })
            ->where('user_id', auth()->id())
            ->with(['user', 'items'])
            ->latest('created_at')
            ->get();


        return Inertia::render('Inventory/Index', [
            'inventories' => $inventories,
            'search' => $request->search
        ]);
    }



    public function create(Request $request): \Inertia\Response
    {
        return Inertia::render('Inventory/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->user_id = auth()->id();
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->save();

        return Response::json(['message' => 'Inventory added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }


    public function edit(Inventory $inventory)
    {
        return Inertia::render('Inventory/Edit', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->save();

        return Response::json(['message' => 'Inventory updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return Response::json(['message' => 'Inventory has been deleted']);
    }
}
