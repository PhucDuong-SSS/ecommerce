<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name ='admin';
        $user->username ='admin';
        $user->email ='admin@gmail.com';
        $user->phone ='0975396865';
        $user->category =1;
        $user->coupon =1;
        $user->blog =1;
        $user->order =1;
        $user->other =1;
        $user->report =1;
        $user->role =1;
        $user->return =1;
        $user->contact =1;
        $user->comment =1;
        $user->setting =1;
        $user->stock =1;
        $user->type =1;


        $user->save();
    }
}
