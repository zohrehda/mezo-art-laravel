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
        DB::statement('CREATE VIEW print_orders_v AS SELECT 
         print_orders.id,
         print_orders.user_id,
         print_orders.code,
         print_orders.fabric_material_id,
         print_orders.print_type,
         print_orders.design_type,
         print_orders.fabric_name,
          print_orders.fabric_country_of_origin,
         print_orders.fabric_colorability,
         print_orders.fabric_weight,
         print_orders.fabric_color,
         print_orders.fabric_shrink,
         print_orders.press,
         print_orders.admin_access,
         print_orders.user_access,
         print_orders.status,
         print_orders.created_by,
         print_orders.updated_by,
         print_orders.created_at,
        
         greatest(print_orders.updated_at,MAX(print_order_files.updated_at), COALESCE(MAX(print_order_patterns.updated_at),0),
                                COALESCE(MAX(print_order_rolls.updated_at),0)
                                ) as updated_at

         FROM print_orders 

         LEFT JOIN print_order_files ON print_orders.id=print_order_files.print_order_id
LEFT JOIN print_order_patterns ON print_orders.id=print_order_patterns.print_order_id
LEFT JOIN print_order_rolls ON print_orders.id=print_order_rolls.print_order_id
GROUP BY print_orders.id;
        

      ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW print_orders_v');
    }
};
