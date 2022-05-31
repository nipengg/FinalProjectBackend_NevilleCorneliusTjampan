<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();
        // dd($products);
        return view('shop')->with(['products' => $products]);
    }

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('cart')->with(['cartCollection' => $cartCollection]);;
    }

    public function add(Request $request)
    {
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request)
    {
        \Cart::update(
            $request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            )
        );
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }

    public function print()
    {
        $cartCollection = \Cart::getContent();
        $date = Carbon::now()->toDateTimeString();
        $userId = Auth::user()->id;
        $in = uniqid();

        foreach ($cartCollection as $item) {
            DB::insert("
                    INSERT INTO invoices
                    (invoice_id, product_id, qty, total, user_id, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
            ", [$in, $item['id'], $item['quantity'], $item['price'], $userId, $date, $date]);

            DB::update("
                UPDATE products
                SET quantity = quantity - ?
                WHERE id = ?
            ", [$item['quantity'], $item['id']]);
        }
        \Cart::clear();
        DB::commit();
        return redirect()->route('dashboard')->with('success_msg', 'Success!');
    }
}
