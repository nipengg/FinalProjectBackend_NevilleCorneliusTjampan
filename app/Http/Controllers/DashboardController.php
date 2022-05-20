<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.dashboard', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('/images', 'public');

        Product::create($data);
        return redirect()->route('admin');
    }

    public function edit($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('/images', 'public');

        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin');
    }
}
