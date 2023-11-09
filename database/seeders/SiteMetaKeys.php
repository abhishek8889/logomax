<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteMetaKeys extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_metas')->truncate();
        $meta_keys = array(
            ['meta_name' => 'Home Banner','meta_key' => 'home-banner' , 'meta_value' => '','meta_type' => 'image' ,'status' => 1],
            ['meta_name' => 'Home Page Site Logo','meta_key' => 'home-page-site-logo' , 'meta_value' => '','meta_type' => 'image','status' => 1],
            ['meta_name' => 'Other pages Site Logo','meta_key' => 'other-pages-site-logo' , 'meta_value' => '','meta_type' => 'image','status' => 1],
            ['meta_name' => 'Footer Logo','meta_key' => 'footer-logo' , 'meta_value' => '','meta_type' => 'image','status' => 1],
        );
        foreach($meta_keys as $keys){
            DB::table('site_metas')->insert([
                'meta_name' => $keys['meta_name'],
                'meta_key' => $keys['meta_key'],
                'meta_value' => $keys['meta_value'],
                'meta_type' => $keys['meta_type'],
                'status' => $keys['status'],
            ]);
        }
    }
}
