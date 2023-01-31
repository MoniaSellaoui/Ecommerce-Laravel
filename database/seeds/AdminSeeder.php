<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(['name'=>'Admin',
        'email'=>'admin@gmail.com',
        'role'=>'admin',
        'password'=>Hash::make('12345678')]);
    }
}
