<?php

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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);
        $admin =\App\Models\User::where('email','admin@gmail.com')->first();
        \Illuminate\Support\Facades\DB::table('user_roles')->insert([
            'user_id' => $admin->id,
            'role_id' => '1',
        ]);

    }
}
