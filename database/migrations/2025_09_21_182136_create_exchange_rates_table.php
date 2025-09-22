<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency', 10); // FCFA
            $table->string('to_currency', 10);   // RUB
            $table->decimal('rate', 10, 4);      // 0.14
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['from_currency', 'to_currency']);
        });
        
        // Insertion des taux par défaut
        DB::table('exchange_rates')->insert([
            ['from_currency' => 'FCFA', 'to_currency' => 'RUB', 'rate' => 0.14, 'created_at' => now(), 'updated_at' => now()],
            ['from_currency' => 'RUB', 'to_currency' => 'FCFA', 'rate' => 6.63, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
