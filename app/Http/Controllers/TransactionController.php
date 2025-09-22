<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
   public function index()
    {
        $transactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 transactions par page

        return view('exchange.index', compact('transactions'));
    }


   

    public function create()
    {
        $exchangeRates = [
            'FCFA_RUB' => ExchangeRate::getRate('FCFA', 'RUB') ?? 0.14,
            'RUB_FCFA' => ExchangeRate::getRate('RUB', 'FCFA') ?? 7.14
        ];

        return view('exchange.create', compact('exchangeRates'));
    }
    
    public function confirm(Request $request)
{
    $amount = $request->input('amount');
    $from_currency = $request->input('from_currency');
    $to_currency = $request->input('to_currency');
    
    // Récupérer le taux depuis la base de données
    $exchange_rate = ExchangeRate::getRate($from_currency, $to_currency);
    
    if (!$exchange_rate) {
        return redirect()->back()
            ->with('error', 'Taux de change non disponible pour cette paire de devises.');
    }
    
    $converted_amount = $amount * $exchange_rate;

    return view('exchange.confirm', compact(
        'amount', 
        'from_currency', 
        'to_currency', 
        'converted_amount', 
        'exchange_rate'
    ));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'from_currency' => 'required|string|in:FCFA,RUB',
            'to_currency' => 'required|string|in:FCFA,RUB',
            'converted_amount' => 'required|numeric|min:0',
            'exchange_rate' => 'required|numeric',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sender_number' => 'nullable|string',
            'confirmation' => 'required|accepted'
        ]);

        // Traitement de l'image de preuve
        if ($request->hasFile('payment_proof')) {
            $imagePath = $request->file('payment_proof')->store('payment-proofs', 'public');
            $validated['payment_proof'] = $imagePath;
        }

        // Création de la transaction avec la nouvelle structure
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'amount_sended' => $validated['amount'],
            'currency_sended' => $validated['from_currency'],
            'amount_received' => $validated['converted_amount'],
            'currency_received' => $validated['to_currency'],
            'exchange_rate' => $validated['exchange_rate'],
            'payment_proof' => $validated['payment_proof'],
            'sender_number' => $validated['sender_number'],
            'status' => 'en attente'
        ]);

        return redirect()->route('exchange.create')
            ->with('success', 'Votre échange a été soumis avec succès!');
    }
    

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Vérifier que la transaction est en attente
        if ($transaction->status !== 'en attente') {
            return redirect()->back()
                ->with('error', 'Cette transaction a déjà été traitée.');
        }

        $transaction->update([
            'status' => 'approuvé',
            'processed_at' => now(),
            'processed_by' => Auth::id()
        ]);

        // TODO: Envoyer une notification à l'utilisateur

        return redirect()->route('exchange.index')
            ->with('success', 'Transaction approuvée avec succès!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500'
        ]);

        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status !== 'en attente') {
            return redirect()->back()
                ->with('error', 'Cette transaction a déjà été traitée.');
        }

        $transaction->update([
            'status' => 'rejeté',
            'processed_at' => now(),
            'processed_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason
        ]);

        return redirect()->route('exchange.index')
            ->with('success', 'Transaction rejetée avec succès!');
    }

    public function show($id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);
        return view('exchange.show', compact('transaction'));
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
