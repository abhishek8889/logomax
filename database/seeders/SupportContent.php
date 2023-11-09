<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('support_contents')->truncate();   
        $meta_keys = array(
            ['meta_name' => 'Support Text','meta_key' => 'support_text' , 'meta_value' => '','type' => 'textarea'],
        );
        foreach($meta_keys as $keys){
            DB::table('support_contents')->insert([
                'meta_name' => $keys['meta_name'],
                'meta_key' => $keys['meta_key'],
                'meta_value' => $keys['meta_value'],
                'type' => $keys['type'],
            ]);
        }
    }
}
