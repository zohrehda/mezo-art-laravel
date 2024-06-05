<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW routes_v AS SELECT 
      routes.*  ,
      page_builders.title as page_builder_title ,
      page_builders.content as page_builder_content 
      FROM routes
      LEFT JOIN page_builders ON routes.page_builder_id=page_builders.id
      ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW routes_v');
    }
};
