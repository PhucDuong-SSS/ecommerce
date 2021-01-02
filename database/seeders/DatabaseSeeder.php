<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name ='ishop';
        $user->username ='ishop';
        $user->email ='ishop@gmail.com';
        $user->password = bcrypt('123456');
        $user->phone ='0975396855';
        $user->category =1;
        $user->coupon =1;
        $user->product =1;
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
