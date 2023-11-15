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
            [
                'meta_name' => 'Support Text',
                'meta_key' => 'support_text' ,
                 'meta_value' => '',
                 'type' => 'textarea'
                ],
            [
                'meta_name'=>'meta title',
                'meta_key'=>'meta-title',
                'meta_value'=>'test',
                'type'=>'textarea'
                 ],
                [
                    'meta_name'=>'meta description',
                    'meta_key'=>'meta-description',
                    'meta_value'=>'test',
                    'type'=>'textarea'
                ],
                [
                    'meta_name'=>'meta language',
                    'meta_key'=>'meta-language',
                    'meta_value'=>'test',
                    'type'=>'textarea'
                ],
                [
                'meta_name'=>'meta country',
                'meta_key'=>'meta-country',
                'meta_value'=>'test',
                'type'=>'textarea'
            ],
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
