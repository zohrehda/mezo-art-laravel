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
        Schema::create('design_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id');
            $table->string('original_file_path');
            $table->string('fake_file_path');
            $table->string('size')->nullable();
            $table->bigInteger('dpi')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('extension')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_files');
    }
};
