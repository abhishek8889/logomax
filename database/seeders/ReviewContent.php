<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('review_contents')->truncate();
        $about_data = [
            [
            'name'=>'meta title',
            'key'=>'meta-title',
            'value'=>'Logomax | Reviews',
            'type'=>'textarea'
             ],
            [
                'name'=>'meta description',
                'key'=>'meta-description',
                'value'=>'',
                'type'=>'textarea'
            ],
            [
                'name'=>'meta language',
                'key'=>'meta-language',
                'value'=>'en',
                'type'=>'textarea'
            ],
            [
            'name'=>'meta country',
            'key'=>'meta-country',
            'value'=>'',
            'type'=>'textarea'
        ],
        ];
        foreach ($about_data as $data) {
            DB::table('review_contents')->insert([
                'name' => $data['name'],
                'key' => $data['key'],
                'value' => $data['value'],
                'type' => $data['type'],
            ]);
        }
    }
}
