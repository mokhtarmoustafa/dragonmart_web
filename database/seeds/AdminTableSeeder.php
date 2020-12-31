<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $admin = new \App\Admin();
        $admin->name = 'Super Admin';
        $admin->username = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->mobile = '111111111';
        $admin->type = 'admin';
        $admin->status = 1;
        $admin->save();

//        $admin = new \App\Admin();
//        $admin->name = 'Merchant';
//        $admin->username = 'merchant';
//        $admin->email = 'merchant@merchant.com';
//        $admin->password = bcrypt('123456');
//        $admin->mobile = '222222222';
//        $admin->type = 'merchant';
//        $admin->status = 1;
//        $admin->user_id = 1;
//        $admin->save();
    }
}
