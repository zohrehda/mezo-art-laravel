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
        Schema::create('print_order_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_order_id')->constrained('print_orders')->onDelete('cascade');
            $table->string('approval_method')->nullable();
            $table->dateTime('operator_approval_date')->nullable();
            $table->dateTime('sample_approval_date')->nullable();
            $table->dateTime('warehouse_approval_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->bigInteger('prepayment_amount')->nullable();
            $table->bigInteger('additional_services_cost')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_order_assessments');
    }
};
