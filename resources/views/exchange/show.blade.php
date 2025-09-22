@extends('layouts.dash')

@section('title', 'Détails de la Transaction - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Détails de la Transaction #{{ $transaction->id }}</h1>
        <a href="{{ route('exchange.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Retour
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informations de la transaction -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Informations de la transaction</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Utilisateur:</span>
                    <span class="font-medium">{{ $transaction->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium">{{ $transaction->user->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Type:</span>
                    <span class="font-medium">{{ $transaction->currency_sended }} → {{ $transaction->currency_received }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Montant envoyé:</span>
                    <span class="font-medium">{{ number_format($transaction->amount_sended, 0, ',', ' ') }} {{ $transaction->currency_sended }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Montant à recevoir:</span>
                    <span class="font-medium text-green-600">{{ number_format($transaction->amount_received, 0, ',', ' ') }} {{ $transaction->currency_received }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Taux appliqué:</span>
                    <span class="font-medium">1 {{ $transaction->currency_sended }} = {{ $transaction->exchange_rate }} {{ $transaction->currency_received }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Statut:</span>
                    <span class="px-2 py-1 rounded-full text-xs {{ $transaction->status == 'approuvé' ? 'bg-green-100 text-green-800' : ($transaction->status == 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $transaction->status }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date:</span>
                    <span class="font-medium">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                </div>
                @if($transaction->processed_at)
                <div class="flex justify-between">
                    <span class="text-gray-600">Traité le:</span>
                    <span class="font-medium">{{ $transaction->processed_at->format('d/m/Y H:i') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Preuve de paiement et actions -->
        <div class="space-y-6">
            <!-- Preuve de paiement -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Preuve de paiement</h2>
                
                @if($transaction->payment_proof)
                <div class="text-center">
                    <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                         alt="Preuve de paiement" 
                         class="max-w-full h-64 object-contain mx-auto rounded-lg border">
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $transaction->payment_proof) }}" 
                           target="_blank" 
                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Agrandir l'image
                        </a>
                    </div>
                </div>
                @else
                <p class="text-red-500">Aucune preuve de paiement fournie</p>
                @endif
            </div>

            <!-- Actions d'administration -->
            @if($transaction->status == 'en attente')
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Actions</h2>
                
                <div class="space-y-4">
                    <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                            ✅ Approuver la transaction
                        </button>
                    </form>

                    <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST" id="rejectForm">
                        @csrf
                        <div class="mb-3">
                            <label for="rejection_reason" class="block text-sm font-medium text-gray-700">
                                Raison du rejet (optionnel)
                            </label>
                            <textarea name="rejection_reason" id="rejection_reason" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                                      placeholder="Pourquoi rejetez-vous cette transaction?"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                            ❌ Rejeter la transaction
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection