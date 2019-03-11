<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'code' => 'admin',
            ],
            [
                'name' => 'Khách Hàng',
                'code' => 'customer',
            ],
            [
                'name' => 'Đơn Hàng',
                'code' => 'order',
            ],
            [
                'name' => 'Sản Phẩm',
                'code' => 'product',
            ],
            [
                'name' => 'Phân Loại',
                'code' => 'category',
            ],
        ]);
    }
}
