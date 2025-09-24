<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if (!$product) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "{$item['name']} is no longer available.");
            }

            if ($product->stock < $item['quantity']) {
                // Fix cart quantity and show message
                Session::put("cart.$id.quantity", $product->stock);

                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        "Maximum available quantity for {$item['name']} is {$product->stock}. We've updated your cart."
                    );
            }

            $total += $product->price * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'total' => $total,
        ]);

        // Save order items + reduce stock
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            $product->decrement('stock', $item['quantity']);
        }

        Session::forget('cart');

        return redirect()
            ->route('checkout.confirmation', $order->id)
            ->with('success', 'Your order has been placed successfully!');
    }

    public function confirmation(Order $order)
    {
        return view('checkout.confirmation', compact('order'));
    }
}
