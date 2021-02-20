<?php

use Illuminate\Database\Seeder;

class usertableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
    		'name'=>'Admin',
	        'email'=>'admin@admin.com',
	        'password'=>password_hash('demo@1234', PASSWORD_DEFAULT)
    	]);
    }
}
