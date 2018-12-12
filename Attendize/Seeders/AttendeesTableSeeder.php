<?php

use Illuminate\Database\Seeder;

class AttendeesTableSeeder extends Seeder
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
	        DB::table('attendees')->insert([
	        	'id' => $i,
	        	'event_id' => 2,
	        	'order_id' => $i,
	        	'ticket_id' => $i,
	        	'first_name' => $i,
	        	'last_name' => $i,
	        	'email' => $i . "@aaa.com",
	        	'private_reference_number' => "lwuejY0TaBj1CnF",
	        	'account_id' => 1,
	        	'reference_index' => 1,
	        ]);

	        DB::table('tickets')
	        	->where('id', $i)
	        	->decrement('quantity_available', 1);

	        DB::table('tickets')
	        	->where('id', $i)
	        	->increment('quantity_sold', 1);

	        $i = $i + 1;
    	}
    }
}
