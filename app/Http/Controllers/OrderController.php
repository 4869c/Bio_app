<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show order confirmation page after payment.
    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);

        // Make sure the user can only see their own order.
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.confirmation', compact('order'));
    }
}
