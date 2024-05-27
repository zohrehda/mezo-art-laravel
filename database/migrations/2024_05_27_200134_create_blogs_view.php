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
        DB::statement("CREATE VIEW  blogs_v AS SELECT 
        blogs.* , 
        users.first_name as author_first_name ,
        users.last_name as author_last_name ,
        categories.name as category_name ,
        categories.color as category_color 
           FROM blogs 
             LEFT JOIN users ON blogs.author_id=users.id 
             LEFT JOIN categories ON blogs.category_id=categories.id 
             LEFT JOIN likes ON blogs.id=likes.likeable_id  


              ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW blogs_v");

    }
};
