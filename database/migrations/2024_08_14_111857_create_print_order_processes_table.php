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
        Schema::create('print_order_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_order_id')->constrained('print_orders')->onDelete('cascade');
            $table->foreignId('print_order_assessment_id')->constrained('print_order_assessments')->onDelete('cascade');
            $table->dateTime('confirmation_date')->nullable();
            $table->dateTime('preparation_date')->nullable();
            $table->dateTime('printing_house_reference_date')->nullable();
            $table->dateTime('fabric_placement_date')->nullable();
            $table->dateTime('observer_presence_date')->nullable();
            $table->dateTime('completion_date')->nullable();
            $table->dateTime('estimatedـdeliveryـtime_date')->nullable();
            $table->dateTime('deliveryـtime_date')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_order_processes');
    }
};
