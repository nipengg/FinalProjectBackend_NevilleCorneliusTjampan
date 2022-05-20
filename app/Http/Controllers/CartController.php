<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();
        // dd($products);
        return view('shop')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        dd($cartCollection);
        return view('cart')->with(['cartCollection' => $cartCollection]);;
    }

}