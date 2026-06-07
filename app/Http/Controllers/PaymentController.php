<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session('checkout') || empty(session('cart'))) {
            return redirect()->route('cart.index')
                ->with('error', 'No checkout in progress.');
        }
        return view('payment.index');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'card_number'  => 'required|string',
            'card_holder'  => 'required|string',
            'expiry'       => 'required|string',
            'cvv'          => 'required|string',
        ]);

        $cart = session('cart', []);
        $checkout = session('checkout', []);

        if (empty($cart) || empty($checkout)) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart or checkout info missing.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = DB::transaction(function () use ($cart, $checkout, $total) {
            $order = Order::create([
                'user_id'          => Auth::id(),
                'customer_name'    => $checkout['customer_name'],
                'customer_email'   => $checkout['customer_email'],
                'customer_phone'   => $checkout['customer_phone'] ?? null,
                'customer_address' => $checkout['customer_address'],
                'total'            => $total,
                'payment_status'   => 'paid',
                'order_status'     => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $productId,
                    'product_name' => $item['name'],
                    'unit_price'   => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['price'] * $item['quantity'],
                ]);

                $product = Product::find($productId);
                if ($product) {
                    $product->quantity = max(0, $product->quantity - $item['quantity']);
                    $product->save();
                }
            }

            return $order;
        });

        session()->forget('cart');
        session()->forget('checkout');

        return redirect()->route('orders.confirmation', $order->id);
    }
}
