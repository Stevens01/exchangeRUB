<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRateHistory extends Model
{
    use HasFactory;
     protected $fillable = [
        'from_currency',
        'to_currency',
        'old_rate',
        'new_rate',
        'changed_by'
    ];

    protected $casts = [
        'old_rate' => 'decimal:4',
        'new_rate' => 'decimal:4'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
