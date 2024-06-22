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
        // DB::statement("CREATE VIEW  blogs_v AS SELECT 
        // count(likes.id) as like_count ,
        // blogs.* , 
        // users.first_name as author_first_name ,
        // users.last_name as author_last_name ,
        // categories.name as category_name ,
        // categories.color as category_color ,   
        // poster_file.id as poster_file_id ,
        // poster_file.path as poster_file_path ,
        // poster_file.size as poster_file_size ,
        // poster_file.mime_type as poster_file_mime_type ,
        // poster_file.extension as poster_file_extension ,

        // thumbnail_file.id as thumbnail_file_id ,
        // thumbnail_file.path as thumbnail_file_path ,
        // thumbnail_file.size as thumbnail_file_size ,
        // thumbnail_file.mime_type as thumbnail_file_mime_type ,
        // thumbnail_file.extension as thumbnail_file_extension 

        //    FROM blogs 
        //      LEFT JOIN users ON blogs.author_id=users.id 
        //      LEFT JOIN categories ON blogs.category_id=categories.id 
        //      LEFT JOIN likes ON blogs.id=likes.likeable_id   and likes.likeable_type='App\\\Models\\\Blog'
        //      LEFT JOIN fileables as poster  on poster.fileable_id=blogs.id and poster.fileable_type='App\\\Models\\\Blog' and poster.section='poster'
        //      LEFT JOIN fileables as thumbnail  on thumbnail.fileable_id=blogs.id and thumbnail.fileable_type='App\\\Models\\\Blog' and thumbnail.section='thumbnail'
        //      LEFT JOIN files as thumbnail_file on thumbnail_file.id=thumbnail.file_id
        //      LEFT JOIN files as poster_file on poster_file.id=poster.file_id

        //   GROUP BY blogs.id , poster_file.id,thumbnail_file.id
        //       ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::statement("DROP VIEW blogs_v");

    }
};
