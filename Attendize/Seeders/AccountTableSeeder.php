<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $i = 2;
    	while($i <= 20000){
	        DB::table('accounts')->insert([
	        	'id' => $i,
	        	'first_name' => $i,
	        	'last_name' => $i,
	        	'email' => $i . "@aaa.com",
	        	'timezone_id' => 30,
	        	'currency_id' => 2,
	        	'payment_gateway_id' => 1,
	        ]);

	        $i = $i + 1;
    	}
    }
}
