@extends('layouts.dash')

@section('title', 'Utilisateurs en attente - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Utilisateurs en attente de validation</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($users->isEmpty())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            Aucun utilisateur en attente de validation.
        </div>
    @else
        <!-- Conteneur global avec scroll horizontal sur mobile -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase border-b">Nom</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase border-b">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase border-b">Passeport</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase border-b">Date d'inscription</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $user->email }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    @if($user->img_passport)
                                        <a href="{{ asset('storage/' . $user->img_passport) }}" target="_blank" class="text-blue-600 hover:underline">
                                            Voir
                                        </a>
                                    @else
                                        <span class="text-red-600">Non fourni</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.user.show', $user->id) }}"
                                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs">
                                            Voir
                                        </a>
                                        <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">
                                                Valider
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.user.reject', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs"
                                                onclick="return confirm('Êtes-vous sûr de vouloir rejeter cet utilisateur ?')">
                                                Rejeter
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
