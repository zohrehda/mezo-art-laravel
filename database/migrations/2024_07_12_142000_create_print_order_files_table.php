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
            $table->foreignId('pattern_id')->nullable();
            $table->unsignedDouble('design_width')->nullable();
            $table->unsignedDouble('design_height')->nullable();
            $table->double('design_resize_scale')->nullable();
            $table->unsignedBigInteger('roll_size')->nullable();
            $table->unsignedBigInteger('count')->nullable();
            $table->unsignedBigInteger('design_direction')->nullable();
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
