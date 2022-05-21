<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.dashboard', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Category::create($data);
        return redirect()->route('category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', ['category' => $category]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $item = Category::findOrFail($id);
        $item->update($data);

        return redirect()->route('category');
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->route('category');
    }
}
