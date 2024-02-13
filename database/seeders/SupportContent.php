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
        $languageList = array(
            'en-us'=>'United States - English',
                'en-au'=>'Australia - English',
                'es-ar' =>'Argentina-Español',
                'en-ca'=>'Canada - English',
                'es-ch'=>'Chile - Español',
                'es-co'=>'Colombia - Español',
                'de-de'=>'Deutschland - Deutsch',
                'es-es'=>'España - Español',
                'es-esu'=>'Estados Unidos - Español',
                'en-hok'=>'Hong Kong - English',
                'en-in'=>'India - English',
                'en-ir'=>'Ireland - English',
                'en-is'=>'Israel - English',
                'en-ma'=>'Malaysia - English',
                'es-me'=>'México - Español',
                'en-nez'=>'New Zealand - English',
                'de-os'=>'Österreich - Deutsch',
                'en-pak'=>'Pakistan - English',
                'es-pe'=>'Perú - Español',
                'en-ph'=>'Philippines - English',
                'de-sc'=>'Schweiz - Deutsch',
                'en-sin'=>'Singapore - English',
                'en-sa'=>'South Africa - English',
                'en-uae'=>'United Arab Emirates - English',
                'en-uk'=>'United Kingdom - English',
                'es-ven'=>'Venezuela - Español'
        );
        $supportContent = array(
            'en-us' =>[
                [
                    'meta_name' => 'Support Text',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'meta_key' => 'support_text' ,
                    'meta_value' => "<p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetive and overused logos, we stand out by offering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it's the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you're a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>",
                    'type' => 'textarea'
                ],
                [
                    'meta_name'=>'meta title',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'meta_key'=>'meta-title',
                    'meta_value'=>'Logomax | Support',
                    'type'=>'textarea'
                 ],
                [
                    'meta_name'=>'meta description',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'meta_key'=>'meta-description',
                    'meta_value'=>'',
                    'type'=>'textarea'
                ],
                [
                    'meta_name'=>'meta language',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'meta_key'=>'meta-language',
                    'meta_value'=>'en',
                    'type'=>'textarea'
                ],
                [
                    'meta_name'=>'meta country',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'meta_key'=>'meta-country',
                    'meta_value'=>'',
                    'type'=>'textarea'
                ],
            ]
        );


        $defaultLangContent = [
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
        ];
        // foreach($meta_keys as $keys){
        //     DB::table('support_contents')->insert([
        //         'meta_name' => $keys['meta_name'],
        //         'meta_key' => $keys['meta_key'],
        //         'meta_value' => $keys['meta_value'],
        //         'type' => $keys['type'],
        //     ]);
        // }

        foreach($languageList as $lang_code => $lang){
            foreach($supportContent as $list_lang => $langData){
                if($lang_code == $list_lang){
                    foreach($langData as $content){
                        DB::table('support_contents')->insert([
                            'meta_name'=>$content['meta_name'],
                            'language'=>$content['language'],
                            'lang_code'=>$content['lang_code'],
                            'meta_key'=>$content['meta_key'],
                            'meta_value'=>$content['meta_value'],
                            'type'=>$content['type'],
                        ]);
                    }
                }else{
                    foreach($defaultLangContent as $content){
                        DB::table('support_contents')->insert([
                            'meta_name'=>$content['meta_name'],
                            'language'=> $lang,
                            'lang_code'=> $lang_code,
                            'meta_key'=>$content['meta_key'],
                            'meta_value'=>$content['meta_value'],
                            'type'=>$content['type'],
                        ]);
                    }    
                }
            }
        }
    }
}
