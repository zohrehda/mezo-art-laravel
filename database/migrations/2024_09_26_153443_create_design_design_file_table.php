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
        Schema::create('design_design_file', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id')->constrained('designs');
            $table->foreignId('design_file_id')->constrained('design_files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_design_file');
    }
};
