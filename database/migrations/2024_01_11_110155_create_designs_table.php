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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('print_type');
            $table->string('design_type');
            $table->boolean('downloadable')->default(true);
            $table->boolean('status')->default(true);
            $table->foreignId('designer_id');
            $table->string('package')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->json('colors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
