<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ],
            [
                'role_id' => 2,
                'name' => 'humas',
                'email' => 'humas@humas.com',
                'password' => bcrypt('humas'),
            ],
            [
                'role_id' => 3,
                'name' => 'opd',
                'email' => 'opd@opd.com',
                'password' => bcrypt('opd'),
            ],

        ];
        DB::table('users')->insert($user);
    }
}
