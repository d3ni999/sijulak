<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'admin', 'desc' => ''],
            ['name' => 'humas', 'desc' => ''],
            ['name' => 'opd', 'desc' => ''],
        ];
        DB::table('roles')->insert($data);
    }
}
