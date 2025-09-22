<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount_sended',
        'currency_sended',
        'amount_received',
        'currency_received',
        'exchange_rate',
        'payment_proof',
        'sender_number',
        'status'
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor pour le statut
     */
    public function getStatusLabelAttribute()
    {
        return [
            'en attente' => 'En attente',
            'approuvé' => 'Approuvé',
            'rejeté' => 'Rejeté'
        ][$this->status] ?? $this->status;
    }
}
