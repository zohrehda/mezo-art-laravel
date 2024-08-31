<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installment_id')->constrained('installments')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('transaction_num')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_receipts');
    }
};
