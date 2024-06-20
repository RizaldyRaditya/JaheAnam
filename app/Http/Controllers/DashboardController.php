<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Order;

class DashboardController extends Controller
{
    public function totalCount()
    {
        $user = User::all();
        $orders = Order::orderBy('created_at', 'desc')->get();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalProduks = Produk::count();
        $totalRevenue = 0;
        foreach ($orders as $order) {
            if ($order->payment_status === 'paid' || $order->status === 'delivered') {
                $totalRevenue += $order->subtotal;
            }
        }
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'user' => $user,
            'orders' => $orders,
            'totalProduks' => $totalProduks,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue
        ]);
    }
}
