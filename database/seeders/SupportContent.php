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
                 'meta_value' => "<p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetive and overused logos, we stand out by offering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it's the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you're a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>",
                 'type' => 'textarea'
                ],
            [
                'meta_name'=>'meta title',
                'meta_key'=>'meta-title',
                'meta_value'=>'Logomax | Support',
                'type'=>'textarea'
                 ],
                [
                    'meta_name'=>'meta description',
                    'meta_key'=>'meta-description',
                    'meta_value'=>'',
                    'type'=>'textarea'
                ],
                [
                    'meta_name'=>'meta language',
                    'meta_key'=>'meta-language',
                    'meta_value'=>'en',
                    'type'=>'textarea'
                ],
                [
                'meta_name'=>'meta country',
                'meta_key'=>'meta-country',
                'meta_value'=>'',
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
