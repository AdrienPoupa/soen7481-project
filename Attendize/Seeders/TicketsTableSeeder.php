<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$i = 2;
    	while($i <= 20000){
	        DB::table('tickets')->insert([
	        	'id' => $i,'created_at' => '2018-11-26 02:50:30',
	        	'updated_at' => '2018-11-26 02:51:35','deleted_at' => NULL,'edited_by_user_id' => NULL,'account_id' => 1,'order_id' => NULL,'event_id' => $i,'title' => 'ticket'.$i,'description' => '','price' => '50.00','max_per_person' => '30','min_per_person' => '1','quantity_available' => '20000','quantity_sold' => '0','start_sale_date' => '2018-11-26 02:50:30','end_sale_date' => NULL,'sales_volume' => '0.00','organiser_fees_volume' => '0.00','is_paused' => '0','public_id' => NULL,'user_id' => 1,'sort_order' => '0','is_hidden' => '0'
	        ]);

	        $i = $i + 1;
    	}
    }
}
