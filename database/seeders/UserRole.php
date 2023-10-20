<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->truncate();
        $user_role = array(
            ['role_id' => 1,'user_type' => 'Simple user'],
            ['role_id' => 2,'user_type' => 'Designer'],
            ['role_id' => 3,'user_type' => 'Admin'],
            ['role_id' => 4,'user_type' => 'Special Designer']
        );
        foreach($user_role as $role){
            DB::table('user_roles')->insert([
                'role_id' => $role['role_id'],
                'role' => $role['user_type'],
            ]);
        }
    }
}
