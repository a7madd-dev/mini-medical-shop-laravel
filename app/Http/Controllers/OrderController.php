<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * List all orders (Admin Side).
     */
    public function index()
    {
        $orders = Order::with('items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show a single order with details.
     */
    public function show(Order $order)
    {
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
}
