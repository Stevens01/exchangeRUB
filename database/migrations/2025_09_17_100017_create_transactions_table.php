<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
             $table->decimal('amount_sended', 15, 2);
            $table->decimal('amount_received', 15, 2);
            $table->string('currency_sended', 10);
            $table->string('currency_received', 10);
            $table->decimal('exchange_rate', 10, 4);
            $table->string('payment_proof')->nullable();
            $table->string('sender_number')->nullable();
            $table->enum('status', ['en attente', 'approuvé', 'rejeté'])->default('en attente');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
