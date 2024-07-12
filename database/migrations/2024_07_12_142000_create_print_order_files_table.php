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
        Schema::create('print_order_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_order_id');
            $table->foreignId('design_file_id');
            $table->unsignedBigInteger('width');
            $table->unsignedBigInteger('height');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_order_files');
    }
};
