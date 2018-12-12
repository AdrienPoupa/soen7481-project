<?php

use Illuminate\Database\Seeder;

class OrganisersTableSeeder extends Seeder
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
	        DB::table('organisers')->insert([
	        	'id' => $i,
	        	'account_id' => $i,
	        	'name' => $i,
	        	'about' => $i,
	        	'email' => $i . "@aaa.com",
	        	'confirmation_key' => "lwuejY0TaBj1CnF",
	        	'facebook' => "",
	        	'twitter' => "",
	        	'tax_name' => "",
	        	'tax_value' => 0,
	        	'tax_id' => "",
	        ]);

	        $i = $i + 1;
    	}
    }
}
