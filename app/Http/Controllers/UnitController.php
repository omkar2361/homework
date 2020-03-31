<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return Unit::all();
    }

    public function show($id)
    {
        return Unit::findOrFail($id);
    }

    public function store(Request $request)
    {
        Unit::store($request);
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $unit->updateUnit($request);
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
    }
}
