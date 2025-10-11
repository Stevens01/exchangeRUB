<!-- resources/views/admin/payment-settings.blade.php -->

@extends('layouts.app')

@section('title', 'Paramètres de Paiement - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- En-tête -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Paramètres de Paiement</h1>
            <p class="text-gray-600 mt-1">Gérez les numéros de paiement pour les transactions</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 text-sm sm:text-base flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Retour au dashboard
            </a>
        </div>
    </div>

    <!-- Messages de statut -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Carte des paramètres -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Numéros de Paiement</h2>
            <p class="text-sm text-gray-600">Ces numéros seront affichés aux utilisateurs lors de la confirmation de transaction</p>
        </div>

        <form action="{{ route('admin.payment_settings.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Numéro FCFA -->
                <div class="space-y-4">
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <h3 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-money-bill-wave"></i>
                            Paiement FCFA (Bénin)
                        </h3>
                        
                        <div class="mb-4">
                            <label for="fcfa_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro de mobile money
                            </label>
                            <input type="text" 
                                   name="fcfa_number" 
                                   id="fcfa_number"
                                   value="{{ old('fcfa_number', $settings['fcfa_number']) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   placeholder="Ex: +229 01 96 45 51 48"
                                   required>
                            @error('fcfa_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-xs text-gray-600 bg-white p-3 rounded border">
                            <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                            {{ $settings['fcfa_description'] }}
                        </div>
                    </div>
                </div>

                <!-- Numéro RUB -->
                <div class="space-y-4">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <h3 class="font-semibold text-green-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-university"></i>
                            Paiement RUB (Russie)
                        </h3>
                        
                        <div class="mb-4">
                            <label for="rub_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro de compte bancaire
                            </label>
                            <input type="text" 
                                   name="rub_number" 
                                   id="rub_number"
                                   value="{{ old('rub_number', $settings['rub_number']) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm"
                                   placeholder="Ex: 2200702005511220"
                                   required>
                            @error('rub_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-xs text-gray-600 bg-white p-3 rounded border">
                            <i class="fas fa-info-circle text-green-500 mr-1"></i>
                            {{ $settings['rub_description'] }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations importantes -->
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h4 class="font-semibold text-yellow-800 mb-2 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    Informations importantes
                </h4>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Les modifications prennent effet immédiatement</li>
                    <li>• Les nouveaux numéros s'appliqueront aux prochaines transactions</li>
                    <li>• Vérifiez attentivement les numéros avant de sauvegarder</li>
                </ul>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-end">
                <button type="reset" 
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 text-sm">
                    <i class="fas fa-undo mr-2"></i>Réinitialiser
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-semibold">
                    <i class="fas fa-save mr-2"></i>Sauvegarder les modifications
                </button>
            </div>
        </form>
    </div>

    <!-- Section d'aperçu -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aperçu utilisateur</h3>
        <p class="text-sm text-gray-600 mb-4">Voici comment les numéros apparaîtront aux utilisateurs :</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Aperçu FCFA -->
            <div class="bg-blue-50 rounded-lg p-4 border">
                <h4 class="font-semibold text-blue-800 mb-2">Paiement FCFA</h4>
                <div class="bg-white rounded p-3 text-center">
                    <p class="text-sm text-gray-600 mb-1">Numéro affiché :</p>
                    <p class="font-mono text-lg font-bold text-blue-700">{{ $settings['fcfa_number'] }}</p>
                </div>
            </div>

            <!-- Aperçu RUB -->
            <div class="bg-green-50 rounded-lg p-4 border">
                <h4 class="font-semibold text-green-800 mb-2">Paiement RUB</h4>
                <div class="bg-white rounded p-3 text-center">
                    <p class="text-sm text-gray-600 mb-1">Numéro affiché :</p>
                    <p class="font-mono text-lg font-bold text-green-700">{{ $settings['rub_number'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animation pour les messages */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des messages
        const messages = document.querySelectorAll('.bg-green-100, .bg-red-100');
        messages.forEach(message => {
            message.classList.add('fade-in');
        });

        // Confirmation avant réinitialisation
        const resetButton = document.querySelector('button[type="reset"]');
        if (resetButton) {
            resetButton.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir réinitialiser les champs ? Les valeurs actuelles seront perdues.')) {
                    e.preventDefault();
                }
            });
        }

        // Auto-hide success message after 5 seconds
        const successMessage = document.querySelector('.bg-green-100');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.remove();
                }, 300);
            }, 5000);
        }
    });
</script>
@endsection