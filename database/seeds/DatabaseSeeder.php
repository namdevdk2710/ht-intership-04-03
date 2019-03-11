<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class); //tạo Role mặc định
        $this->call(UserRolesTableSeeder::class); //tự động tạo USER và thêm USERROLE
<<<<<<< HEAD
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductOptionSeeder::class);     
=======
        $this->call(AdminSeeder::class);
>>>>>>> 805422e2a284abe42b115f2c79050e6dba37dafd
    }
}
