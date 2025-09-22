@extends('layouts.app')

@section('title', 'Gestion des Taux de Change - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Taux de Change</h1>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection