<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total' => Transaction::where('user_id', $user->id)->count(),
            'pending' => Transaction::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'awaiting_payment'])
                ->count(),
            'paid' => Transaction::where('user_id', $user->id)
                ->where('status', 'paid')
                ->count(),
            'cancelled' => Transaction::where('user_id', $user->id)
                ->where('status', 'cancelled')
                ->count(),
        ];

        $transactions = Transaction::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        return view('customer.dashboard', compact('stats', 'transactions'));
    }

}
