<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchange_rate_histories', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency', 10); // RUB, FCFA, etc.
            $table->string('to_currency', 10);   // RUB, FCFA, etc.
            $table->decimal('old_rate', 10, 4);  // Ancien taux
            $table->decimal('new_rate', 10, 4);  // Nouveau taux
            $table->timestamps(); // created_at et updated_at
            
            // Index pour améliorer les performances
            $table->index(['from_currency', 'to_currency']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rate_histories');
    }
};