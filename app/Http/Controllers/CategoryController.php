<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function store(Request $request)
    {
        Category::store($request);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->updateCategory($request);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
    }
}
