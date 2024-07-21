<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\CoreSystemService;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $coreSystemService;

    public function __construct(CoreSystemService $coreSystemService)
    {
        $this->coreSystemService = $coreSystemService;
    }


    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'sku' => 'required|unique:items',
            'description' => 'required',
            'price' => 'required|numeric',
            'count' => 'required|integer',
        ]);

        $item = Item::create($request->all());

        $coreSystemData = $request->only([
            'category', 'name', 'sku', 'description', 'price', 'count', 'remarks'
        ]);

        // Call the API
        $response = $this->coreSystemService->addItem($coreSystemData);
        dd($response);
        if ($response['status'] != 200) {
            return redirect()->route('items.index')->with('error', 'Failed to add item to core system.');
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'count' => 'required|integer',
            'added_date' => 'required|date',
        ]);

        $item->update($request->all());

        // Prepare data for the core system
        $coreSystemData = $request->only([
            'category', 'name', 'description', 'price', 'count', 'remarks'
        ]);

        // Call the API to update the item in the core system
        $response = $this->coreSystemService->updateItem($coreSystemData);
        dd($response);

        if ($response['status'] != 200) {
            return redirect()->route('items.index')->with('error', 'Failed to update item in core system.');
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $response = $this->coreSystemService->removeItem(['sku' => $item->sku]);

//dd($response);

        if ($response['status'] != 200) {
            return redirect()->route('items.index')->with('error', 'Failed to remove item from core system.');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
