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


         users.first_name as user_first_name,
         users.last_name as user_last_name,
         users.mobile as user_mobile,
         user_metas.brand_name as user_brand_name,
         user_metas.address as user_address,
         user_metas.phone_number as user_phone_number,

         cities.name as city_name,
         provinces.name provinces_name,
        
        fabric_materials.name as fabric_material_name ,

        print_order_assessments.preparation_time ,
        print_order_assessments.observer ,
        print_order_assessments.description ,
        print_order_assessments.additional_services_cost ,
        print_order_assessments.prepayment_amount ,
        print_order_assessments.payment_method ,

        print_order_rolls.roll_width,
        print_order_rolls.roll_count,
        print_order_rolls.roll_size,
        print_order_rolls.roll_condition,
        print_order_rolls.roll_shape,
        
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
         LEFT JOIN users ON print_orders.user_id=users.id
         LEFT JOIN user_metas  ON print_orders.user_id=user_metas.user_id
         LEFT JOIN cities  ON user_metas.city_id=cities.id
         LEFT JOIN provinces  ON user_metas.province_id=provinces.id
         LEFT JOIN fabric_materials   ON print_orders.fabric_material_id=fabric_materials.id
         LEFT JOIN print_order_assessments   ON print_orders.id=print_order_assessments.print_order_id
         
         GROUP BY print_orders.id,user_metas.id,print_order_assessments.id,print_order_rolls.id;
        

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
