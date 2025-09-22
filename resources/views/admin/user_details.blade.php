@extends('layouts.dash')

@section('title', 'Détails Utilisateur - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Détails de l'utilisateur</h1>
        <a href="{{ route('admin.pending_users') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Retour
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Informations personnelles</h2>
                <div class="space-y-3">
                    <p><strong>Nom complet:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Numéro de passeport:</strong> {{ $user->num_passport }}</p>
                    <p><strong>Statut:</strong> 
                        <span class="px-2 py-1 rounded text-xs {{ $user->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $user->status ? 'Validé' : 'En attente' }}
                        </span>
                    </p>
                    <p><strong>Rôle:</strong> 
                        <span class="px-2 py-1 rounded text-xs {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $user->role }}
                        </span>
                    </p>
                    <p><strong>Inscrit le:</strong> {{ $user->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Document de passeport</h2>
                @if($user->img_passport)
                    <div class="border rounded-lg p-4">
                        <img src="{{ asset('storage/' . $user->img_passport) }}" 
                             alt="Passeport de {{ $user->name }}" 
                             class="w-full h-auto max-h-80 object-contain mx-auto">
                        <div class="mt-4 text-center">
                            <a href="{{ asset('storage/' . $user->img_passport) }}" 
                               target="_blank" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Agrandir l'image
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-red-500">Aucun document de passeport fourni</p>
                @endif
            </div>
        </div>
    </div>

    @if(!$user->status)
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Actions d'administration</h2>
        <div class="flex space-x-4">
            <form action="{{ route('admin.user.approve', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                    ✅ Valider le compte
                </button>
            </form>
            <form action="{{ route('admin.user.reject', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600"
                        onclick="return confirm('Êtes-vous sûr de vouloir rejeter cet utilisateur ? Cette action est irréversible.')">
                    ❌ Rejeter le compte
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection