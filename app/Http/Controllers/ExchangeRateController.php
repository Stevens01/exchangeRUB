<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\ExchangeRateHistory;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $exchangeRates = ExchangeRate::all();
        
        return view('admin.exchange_rates', compact('exchangeRates'));
    }

    public function indexU()
    {
        $exchangeRates = ExchangeRate::all();
        
        return view('exchange_rates', compact('exchangeRates'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0.0001'
        ]);

        $exchangeRate = ExchangeRate::findOrFail($id);

        // Sauvegarde de l'ancien taux dans l'historique
        ExchangeRateHistory::create([
            'from_currency' => $exchangeRate->from_currency,
            'to_currency' => $exchangeRate->to_currency,
            'old_rate' => $exchangeRate->rate,
            'new_rate' => $request->rate,
            'changed_by' => auth()->id()
        ]);

        // Mise à jour du taux
        $exchangeRate->update(['rate' => $request->rate]);

        return redirect()->route('admin.exchange_rates')
            ->with('success', 'Taux de change mis à jour avec succès!');
    }

    public function toggle($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update(['is_active' => !$exchangeRate->is_active]);

        $status = $exchangeRate->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.exchange_rates')
            ->with('success', "Taux de change {$status} avec succès!");
    }
}
