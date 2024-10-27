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
            $table->string('name')->nullable();
            $table->string('print_type');
            $table->string('design_type');
            $table->boolean('downloadable')->default(true);
            $table->boolean('status')->default(true);
            $table->boolean('private')->default(false);
            $table->foreignId('designer_id');
            $table->string('package')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->json('color_ids')->nullable();
            $table->json('related_ids')->nullable();
            $table->boolean('colored_fabric')->default(0);
            //   $table->json('fabric_colors')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();
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
