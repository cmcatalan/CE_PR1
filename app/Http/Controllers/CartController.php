<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderLine;
use Carbon\Carbon;
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
        $cart = session()->get('cart', []);
        $count_items = 0;
        $total = 0.0;

        foreach ((array)session('cart') as $details)
            $count_items += $details['quantity'];

        foreach ((array)session('cart') as $details)
            $total += ($details['is_sale'] ? $details['sale_price'] : $details['price']) * $details['quantity'];

        return view('components.checkout', ['cart' => $cart, 'count_items' => $count_items, 'total' => $total]);
    }

    public function order(Request $request)
    {
        $total_price = 0.0;

        foreach ((array)session('cart') as $details)
            $total_price += ($details['is_sale'] ? $details['sale_price'] : $details['price']) * $details['quantity'];

        $delivery = $this->GenerateDelivery($request);

        $invoice = $this->GenerateInvoice($request);

        $order = $this->GenerateOrder($request, $delivery->delivery_id, $invoice->invoice_id, $total_price);

        $this->GenerateOrderLines($order->order_id);

        session()->put('cart', []);

        return redirect('/')->with('success', 'Order with id "' . $order->order_id . '" created successfully!');
    }

    private function GenerateDelivery(Request $request): Delivery
    {
        $delivery = new Delivery;
        $delivery->first_name = $request->delivery_first_name;
        $delivery->last_name = $request->delivery_last_name;
        $delivery->person_id = $request->delivery_person_id;
        $delivery->country = $request->delivery_country;
        $delivery->city = $request->delivery_city;
        $delivery->address_zip_code = $request->delivery_address_zip_code;
        $delivery->address = $request->delivery_address;
        $delivery->address_number = $request->delivery_address_number;
        $delivery->address_addition = $request->delivery_address_addition;

        $delivery->save();
        return $delivery;
    }

    private function GenerateInvoice(Request $request): Invoice
    {
        $invoice = new Invoice;

        if (!$request->is_billing_data_different) {
            $invoice->first_name = $request->delivery_first_name;
            $invoice->last_name = $request->delivery_last_name;
            $invoice->person_id = $request->delivery_person_id;
            $invoice->country = $request->delivery_country;
            $invoice->city = $request->delivery_city;
            $invoice->address_zip_code = $request->delivery_address_zip_code;
            $invoice->address = $request->delivery_address;
            $invoice->address_number = $request->delivery_address_number;
            $invoice->address_addition = $request->delivery_address_addition;
        } else {
            $invoice->first_name = $request->invoice_first_name;
            $invoice->last_name = $request->invoice_last_name;
            $invoice->person_id = $request->invoice_person_id;
            $invoice->country = $request->invoice_country;
            $invoice->city = $request->invoice_city;
            $invoice->address_zip_code = $request->invoice_address_zip_code;
            $invoice->address = $request->invoice_address;
            $invoice->address_number = $request->invoice_address_number;
            $invoice->address_addition = $request->invoice_address_addition;
        }
        $invoice->generation_datetime = Carbon::now();

        $invoice->save();
        return $invoice;
    }

    private function GenerateOrder(Request $request, int $delivery_id, int $invoice_id, float $total_price): Order
    {
        $order = new Order;
        $order_status_id = 1; // Ordered

        $order->order_datetime = Carbon::now();
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->delivery_id = $delivery_id;
        $order->invoice_id = $invoice_id;
        $order->order_status_id = $order_status_id;
        $order->total_price = $total_price;

        $order->save();

        return $order;
    }

    private function GenerateOrderLines(int $order_id)
    {
        foreach ((array)session('cart') as $product_id => $details){
            $order_line = new OrderLine;
            $order_line->order_id = $order_id;
            $order_line->product_id = $product_id;
            $order_line->quantity = $details['quantity'];
            $order_line->price = $details['is_sale'] ? $details['sale_price'] : $details['price'];

            $order_line->save();
        }
    }
}
