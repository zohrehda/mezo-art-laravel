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
        DB::statement("CREATE VIEW users_v as 
        SELECT users.*,concat(first_name,' ',last_name) as full_name , 
        COUNT(in_progress.id) as in_progress_print_order_count ,
        cities.name as city_name,
        provinces.name as province_name

        FROM `users`
        LEFT JOIN print_orders in_progress  ON users.id=in_progress.user_id AND in_progress.status='in_progress'
        LEFT JOIN user_metas  ON users.id=user_metas.user_id
        LEFT JOIN cities  ON user_metas.city_id=cities.id
        LEFT JOIN provinces  ON user_metas.province_id=provinces.id

        GROUP BY users.id,user_metas.id, cities.id;

       
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW users_v');
    }
};
