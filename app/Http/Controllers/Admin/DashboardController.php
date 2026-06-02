<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Simple stats for the dashboard.
        $stats = [
            'products' => Product::count(),
            'orders'   => Order::count(),
            'users'    => User::count(),
            'admins'   => Admin::count(),
            'revenue'  => Order::where('payment_status', 'paid')->sum('total'),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
