<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new SiteSetting();
        $site->phone_one = '0975398142';
        $site->email = 'phucngocduong95@gmail.com';
        $site->save();
    }
}
