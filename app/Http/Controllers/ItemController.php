<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required|unique:items',
            'description' => 'required',
            'price' => 'required|numeric',
            'count' => 'required|integer',
        ]);

        $item = Item::create($request->all());

        // Call the API to add the item to the core system
        $this->callApi('add', $item->toArray());

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
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'count' => 'required|integer',
            'added_date' => 'required|date',
        ]);

        $item->update($request->all());

        // Call the API to update the item in the core system
        $this->callApi('update', $item->toArray());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->callApi('remove', ['sku' => $item->sku]);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    private function callApi($action, $data)
    {
        $url = 'https://dpf.directpay.lk/api/inventory/' . $action;
        $response = Http::post($url, $data);
        return $response->json();
    }
}
