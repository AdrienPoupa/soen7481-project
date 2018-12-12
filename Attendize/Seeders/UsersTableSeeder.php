<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
	        DB::table('users')->insert([
	        	'id' => $i,
	        	'account_id' => $i,
	        	'first_name' => $i,
	        	'last_name' => $i,
	        	'password' => bcrypt($i),
	        	'email' => $i . "@aaa.com",
	        	'confirmation_code' => "x7hdQcxL0kZODJia",
	        	'is_registered' => 1,
	        	'is_confirmed' => 1,
	        	'is_parent' => 1,
	        ]);

	        $i = $i + 1;
    	}
    }
}
