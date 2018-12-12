<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
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
	        DB::table('orders')->insert([
	        	'id' => $i,
	        	'account_id' => 1,
	        	'order_status_id' => 1,
	        	'created_at' => '2018-11-26 02:51:35',
	        	'updated_at' => '2018-11-26 02:51:35',
	        	'first_name' => $i,
	        	'last_name' => $i,
	        	'email' => $i . "@aaa.com",
	        	'order_reference' => $i,
	        	'amount' => 0,
	        	'event_id' => 2,
	        	'taxamt' => 0,
	        ]);

	        $i = $i + 1;
    	}
    }
}
