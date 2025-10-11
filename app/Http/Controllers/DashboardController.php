<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Afficher le dashboard administrateur
     */
    public function index()
    {
        // Vérifier que l'utilisateur est bien un administrateur
        if (!auth()->user()->role === 'admin') {
            return redirect()->route('welcome')->with('error', 'Accès non autorisé.');
        }
        
        // Récupérer les données pour le dashboard
        $stats = [
            'totalUsers' => User::count(),
            'pendingUsers' => User::where('status', 0)->count(),
            'approvedUsers' => User::where('status', 1)->count(),
            'adminUsers' => User::where('role', 'admin')->count(),
            'recentUsers' => User::orderBy('created_at', 'desc')->take(5)->get()
        ];

        return view('admin.dashboard', $stats);

    }

    

    /**
     * Liste des utilisateurs en attente de validation
     */
    public function pendingUsers()
    {
        $users = User::where('status', 0)->get();
        return view('admin.pending_users', compact('users'));
    }

    /**
     * Valider un utilisateur
     */
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();

        return redirect()->route('admin.pending_users')
            ->with('success', 'Utilisateur validé avec succès!');
    }

    /**
     * Rejeter un utilisateur
     */
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Ou vous pouvez archiver au lieu de supprimer

        return redirect()->route('admin.pending_users')
            ->with('success', 'Utilisateur rejeté avec succès!');
    }

    /**
     * Liste de tous les utilisateurs
     */
    public function allUsers()
    {
        $users = User::all();
        return view('admin.all_users', compact('users'));
    }

    /**
     * Voir les détails d'un utilisateur
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_details', compact('user'));
    }

}