<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentSettingsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Afficher la page de gestion des numéros de paiement
     */
    public function index()
    {
        $settings = [
            'fcfa_number' => Setting::get('payment_number_fcfa', '+229 01 96 45 51 48'),
            'rub_number' => Setting::get('payment_number_rub', '2200702005511220'),
            'fcfa_description' => Setting::where('key', 'payment_number_fcfa')->first()->description ?? 'Numéro de paiement pour les transactions FCFA',
            'rub_description' => Setting::where('key', 'payment_number_rub')->first()->description ?? 'Numéro de compte pour les transactions RUB',
        ];

        return view('admin.payment_settings', compact('settings'));
    }

    /**
     * Mettre à jour les numéros de paiement
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcfa_number' => 'required|string|max:255',
            'rub_number' => 'required|string|max:255',
        ], [
            'fcfa_number.required' => 'Le numéro FCFA est obligatoire',
            'rub_number.required' => 'Le numéro RUB est obligatoire',
            'fcfa_number.max' => 'Le numéro FCFA ne doit pas dépasser 255 caractères',
            'rub_number.max' => 'Le numéro RUB ne doit pas dépasser 255 caractères',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Setting::set('payment_number_fcfa', $request->fcfa_number);
            Setting::set('payment_number_rub', $request->rub_number);

            return back()->with('success', 'Numéros de paiement mis à jour avec succès!');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }
}
