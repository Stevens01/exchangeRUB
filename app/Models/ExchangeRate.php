<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

      protected $fillable = [
        'from_currency',
        'to_currency',
        'rate',
        'is_active'
    ];

    protected $casts = [
        'rate' => 'decimal:4',
        'is_active' => 'boolean'
    ];

    /**
     * Récupérer le taux de change
     */
    public static function getRate($fromCurrency, $toCurrency)
    {
        return static::where('from_currency', $fromCurrency)
            ->where('to_currency', $toCurrency)
            ->where('is_active', true)
            ->value('rate');
    }

    /**
     * Mettre à jour ou créer un taux
     */
    public static function updateRate($fromCurrency, $toCurrency, $rate)
    {
        return static::updateOrCreate(
            [
                'from_currency' => $fromCurrency,
                'to_currency' => $toCurrency
            ],
            ['rate' => $rate]
        );
    }
}
