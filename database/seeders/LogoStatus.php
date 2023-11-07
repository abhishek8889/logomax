<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LogoStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logo_status')->truncate();
        $logo_status = array(
            ['status' => 1,'name' => 'for sale'],
            ['status' => 2,'name' => 'on revision'],
            ['status' => 3,'name' => 'sold'],
        );
        foreach($logo_status as $status){
            DB::table('logo_status')->insert([
                'status' => $status['status'],
                'name' => $status['name'],
            ]);
        }
    }
}
