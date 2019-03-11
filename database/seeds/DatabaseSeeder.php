<?php

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
//        $this->call(RolesTableSeeder::class); //tạo Role mặc định
//        $this->call(UserRolesTableSeeder::class); //tự động tạo USER và thêm USERROLE
        $this->call(AdminSeeder::class);
    }
}
