<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $count_items = 0;
        $total = 0.0;

        foreach ((array)session('cart') as $details)
            $count_items += $details['quantity'];

        foreach ((array)session('cart') as $details)
            $total += ($details['is_sale'] ? $details['sale_price'] : $details['price']) * $details['quantity'];

        return view('components.cart', ['cart' => $cart, 'count_items' => $count_items, 'total' => $total]);
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = 1;
        var_dump($quantity);
        if (isset($cart[$id])) {
            $quantity = $cart[$id]['quantity'] + 1;
        }

        $cart[$id] = [
            "name" => $product->name,
            "manufacturer" => $product->manufacturer,
            "quantity" => $quantity,
            "price" => $product->price,
            "is_sale" => $product->is_sale,
            "sale_price" => $product->sale_price,
            "image_path" => $product->image_path,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            if ($request->quantity <= 0)
                unset($cart[$request->id]);
            else
                $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


    public function checkout()
    {
        return view('components.checkout');
    }
}
