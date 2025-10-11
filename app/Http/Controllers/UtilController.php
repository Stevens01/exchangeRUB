<?php

namespace App\Http\Controllers;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function propos()
    {
        return view('propos');
    }

    public function work()
    {
        return view('work');
    }

    public function indexU()
    {
        $exchangeRates = ExchangeRate::all();
        
        return view('exchange_rates', compact('exchangeRates'));
    }

    public function transaction()
    {
        $transactions = \App\Models\Transaction::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        $completedCount = $transactions->where('status', 'approuvé')->count();
        $pendingCount = $transactions->where('status', 'en attente')->count();
        
        return view('transaction', compact('transactions', 'completedCount', 'pendingCount'));
    }
}
