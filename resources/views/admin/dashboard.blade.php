@extends('layouts.dash')

@section('title', 'Dashboard - ExchangeRUB')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="dashboard-card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                    <i class="fas fa-exchange-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Transactions Today</p>
                    <h3 class="text-2xl font-bold">142</h3>
                </div>
            </div>
        </div>
        
        <div class="dashboard-card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Revenue Today</p>
                    <h3 class="text-2xl font-bold">₣ 3,256</h3>
                </div>
            </div>
        </div>
        <div class="dashboard-card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-600">Utilisateurs totaux</p>
                    <h3 class="text-2xl font-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        
        <div class="dashboard-card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-red-100 text-red-600">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Conversion Rate</p>
                    <h3 class="text-2xl font-bold">98.3%</h3>
                </div>
            </div>
        </div>
    </div>

    
        
@endsection