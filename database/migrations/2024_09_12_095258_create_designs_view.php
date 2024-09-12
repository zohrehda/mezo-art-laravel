<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW designs_v AS SELECT 
        designs.* ,
        categories.name as category_name,
        GROUP_CONCAT(tags.name separator '-' )  as tags_name ,
        CONCAT( replace(categories.name,'/','-') ,'/', 
        designs.code , '/', GROUP_CONCAT(tags.name separator '-' )
         ) as slug
          FROM designs
        LEFT JOIN categories ON  designs.category_id=categories.id   
        LEFT JOIN taggables  ON  designs.id = taggables.taggable_id and taggables.taggable_type='App\\\Models\\\Design'
        LEFT JOIN tags  ON  tags.id = taggables.tag_id 

        GROUP BY designs.id

        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(query: 'DROP VIEW designs_v');

    }
};
