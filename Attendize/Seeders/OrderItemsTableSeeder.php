<?php

use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
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
	        DB::table('order_items')->insert([
	        	'id' => $i,
	        	'title' => 'ticket1',
	        	'quantity' => 1,
	        	'unit_price' => 0,
	        	'order_id' => $i,
	        ]);

	        $i = $i + 1;
    	}
    }
}
