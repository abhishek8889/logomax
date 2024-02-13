<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LogoFacilitiesList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logo_facilities')->truncate(); 
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
        
        $logoFacilitiesContent = array(
            'en-us' =>[
                [
                    'facilities_name' => 'Rapid, Free Customization', 
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>'Download your logo files instantly upon purchase. Need adjustments? Our complimentary customizaon service delivers changes within 1 business day. Enjoy up to 3 revisions, covering brand name, colors, and fonts to ensure your logo perfectly suits your vision.',
                    'status'=>'1',
                ],
                [
                    'facilities_name' => 'Exclusivity Guaranteed',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>'Each logo is designed to be one-of-a-kind and will only be sold to a single customer. This means your brand will have a unique identy that stands out from competors, and you can be confident in a logo that truly represents your business.',
                    'status'=>'1',
                ],
                [
                    'facilities_name' => 'Ready to Use',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>"As predesigned logos, they're ready to be used right away. No waing for designers to create something from scratch – you can start building your brand immediately.",
                    'status'=>'1',
                ],
                [
                    'facilities_name' => 'Brand Registraon Allowed',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>"We allow brand registraon, ensuring that your chosen logo is legally protected. This helps you establish your brand's authencity and safeguards it from potenal infringements.",
                    'status'=>'1',
                ],
                [
                    'facilities_name' => 'Affordable Pricing',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>"Building a brand doesn't have to break the bank. Our logos offer a cost-effecve soluon for businesses looking to establish a strong visual identy.",
                    'status'=>'1',
                ],
                [
                    'facilities_name' => 'Unrestricted License: Your Brand, Your Terms',
                    'language'=>'United States - English',
                    'lang_code'=>'en-us',
                    'description'=>"Our licensing agreement grants you exclusive ownership of the logo. Feel free to ulize it in any manner you prefer, without the need to acknowledge us. Shape your brand identy on your terms.",
                    'status'=>'1',
                ],
            ]
        );

        $defaultLangContent = [
            [
                'facilities_name' => 'Rapid, Free Customization', 
                'description'=>'Download your logo files instantly upon purchase. Need adjustments? Our complimentary customizaon service delivers changes within 1 business day. Enjoy up to 3 revisions, covering brand name, colors, and fonts to ensure your logo perfectly suits your vision.',
                'status'=>'1',
            ],
            [
                'facilities_name' => 'Exclusivity Guaranteed',
                'description'=>'Each logo is designed to be one-of-a-kind and will only be sold to a single customer. This means your brand will have a unique identy that stands out from competors, and you can be confident in a logo that truly represents your business.',
                'status'=>'1',
            ],
            [
                'facilities_name' => 'Ready to Use',
                'description'=>"As predesigned logos, they're ready to be used right away. No waing for designers to create something from scratch – you can start building your brand immediately.",
                'status'=>'1',
            ],
            [
                'facilities_name' => 'Brand Registraon Allowed',
                'description'=>"We allow brand registraon, ensuring that your chosen logo is legally protected. This helps you establish your brand's authencity and safeguards it from potenal infringements.",
                'status'=>'1',
            ],
            [
                'facilities_name' => 'Affordable Pricing',
                'description'=>"Building a brand doesn't have to break the bank. Our logos offer a cost-effecve soluon for businesses looking to establish a strong visual identy.",
                'status'=>'1',
            ],
            [
                'facilities_name' => 'Unrestricted License: Your Brand, Your Terms',
                'description'=>"Our licensing agreement grants you exclusive ownership of the logo. Feel free to ulize it in any manner you prefer, without the need to acknowledge us. Shape your brand identy on your terms.",
                'status'=>'1',
            ],
        ];
        foreach($languageList as $lang_code => $lang){
            foreach($logoFacilitiesContent as $list_lang => $langData){
                if($lang_code == $list_lang){
                    foreach($langData as $content){
                        DB::table('logo_facilities')->insert([
                            'facilities_name'=>$content['facilities_name'],
                            'language'=>$content['language'],
                            'lang_code'=>$content['lang_code'],
                            'description'=>$content['description'],
                            'status'=>$content['status'],
                        ]);
                    }
                }else{
                    foreach($defaultLangContent as $content){
                        DB::table('logo_facilities')->insert([
                            'facilities_name'=>$content['facilities_name'],
                            'language'=> $lang,
                            'lang_code'=> $lang_code,
                            'description'=>$content['description'],
                            'status'=>$content['status'],
                        ]);
                    }    
                }
            }
        }

    }
}
