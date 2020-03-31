<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::all();
    }

    public function show($id)
    {
        return Inventory::findOrFail($id);
    }

    public function store(Request $request)
    {
        Inventory::store($request);
    }

    public function update(Request $request, $id)
    {
        $inventory = new Inventory();

        $inventory->updateInventory($request);
    }

    public function destroy($id)
    {
        Inventory::findOrFail($id)->delete();
    }
}
