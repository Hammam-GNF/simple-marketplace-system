<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'products' => Product::count(),
            'pending' => Transaction::whereIn('status', ['pending', 'awaiting_payment'])->count(),
            'paid' => Transaction::where('status', 'paid')->count(),
            'cancelled' => Transaction::where('status', 'cancelled')->count(),
            'total' => Transaction::count(),
        ];

        $transactions = Transaction::with(['user', 'product'])
            ->latest()
            ->paginate(5);

        return view('admin.dashboard', compact('stats', 'transactions'));
    }
}
