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
        Schema::create('print_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('print_type');
            $table->string('design_type');
            $table->string('fabric_name')->nullable();
            $table->string('fabric_type')->nullable();
            $table->string('fabric_weight')->nullable();
            $table->string('fabric_material')->nullable();
            $table->string('status')->default('created'); //created, 
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_orders');
    }
};
