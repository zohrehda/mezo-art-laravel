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
        Schema::create('user_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('brand_name')->nullable();
            $table->string('guild')->nullable();
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->text('address')->nullable();
            $table->dateTime('est_year')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_metas');
    }
};
