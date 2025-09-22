@extends('layouts.dash')

@section('title', 'Gestion des Taux de Change - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestion des Taux de Change</h1>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tableau des taux de change -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Devise source</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Devise cible</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Taux actuel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nouveau taux</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($exchangeRates as $rate)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            {{ $rate->from_currency }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                            {{ $rate->to_currency }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-lg">
                        {{ number_format($rate->rate, 4) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.exchange-rates.update', $rate->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="rate" step="0.0001" 
                                   value="{{ old('rate', $rate->rate) }}"
                                   class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                   required>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs {{ $rate->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $rate->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.exchange-rates.toggle', $rate->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="{{ $rate->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-3 py-1 rounded-lg">
                                {{ $rate->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection