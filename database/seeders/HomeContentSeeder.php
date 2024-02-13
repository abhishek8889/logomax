<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content =  HomeContent::truncate();
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

        $homeContent = [
            'en-us' =>[
                ['name'=>'register background image','language'=>'United States - English','lang_code'=>'en-us','key'=>'register-background-image','value'=>'1_1699516775.png','type'=>'image'],
                ['name'=>'unique logos from text','language'=>'United States - English','lang_code'=>'en-us','key'=>'unique-logos-from-text','value'=>'<h5>Unique logos from <span>$149</span></h5>','type'=>'textarea'],
                ['name'=>'professional logos title','language'=>'United States - English','lang_code'=>'en-us','key'=>'professional-logos-title','value'=>'Thousands of Unique Logos for Your Success','type'=>'textarea'],
                ['name'=>'professional logos text','language'=>'United States - English','lang_code'=>'en-us','key'=>'professional-logos-text','value'=>"<p>Discover our exclusive logo collection, where each unique design is sold only once,ensuring your brand stands out. Our range of logos, crafted by world-class designers, is ideal for everyone from startups to established businesses, enhancing your brand's identity and elevating your market presence.</p><p>&nbsp;</p>",'type'=>'textarea'],
                ['name'=>'registerbanner title','language'=>'United States - English','lang_code'=>'en-us','key'=>'registerbanner-title','value'=>'Register to Find Your Perfect Logo','type'=>'textarea'],
                ['name'=>'register banner title desc','language'=>'United States - English','lang_code'=>'en-us','key'=>'register-banner-title-desc','value'=>'','type'=>'textarea'],
                ['name'=>'register banner title text desc','language'=>'United States - English','lang_code'=>'en-us','key'=>'register-banner-title-text-desc','value'=>"<p>Logomax is more than just a logo marketplace &ndash; it elevates Your Brand's Identity and Path to Success.</p>",'type'=>'textarea'],
                ['name'=>'customer review title','language'=>'United States - English','lang_code'=>'en-us','key'=>'customer-review-title','value'=>'Why our customers love Logomax','type'=>'textarea'],
                ['name'=>'customer review text','language'=>'United States - English','lang_code'=>'en-us','key'=>'customer-review-text','value'=>"<p>Thousands of customers have chosen Logomax to deﬁne their brand's identity. Our exclusive, one-of-a- kind logos have helped businesses of all sizes make a lasting impression. Explore their success stories and see why they trust Logomax to realize their brand vision.</p>",'type'=>'textarea'],
                ['name'=>'discover trending title','language'=>'United States - English','lang_code'=>'en-us','key'=>'discover-trending-title','value'=>"Discover what's Trending",'type'=>'textarea'],
                ['name'=>'meta title','language'=>'United States - English','lang_code'=>'en-us','key'=>'meta-title','value'=>'Logomax | Home','type'=>'textarea'],
                ['name'=>'meta description','language'=>'United States - English','lang_code'=>'en-us','key'=>'meta-description','value'=>'','type'=>'textarea'],
                ['name'=>'meta language','language'=>'United States - English','lang_code'=>'en-us','key'=>'meta-language','value'=>'en','type'=>'textarea'],
                ['name'=>'meta country','language'=>'United States - English','lang_code'=>'en-us','key'=>'meta-country','value'=>'','type'=>'textarea'],
            ],
        ];

        $defaultLangContent = [
            ['name'=>'register background image','key'=>'register-background-image','value'=>'1_1699516775.png','type'=>'image'],
            ['name'=>'unique logos from text','key'=>'unique-logos-from-text','value'=>'<h5>Unique logos from <span>$149</span></h5>','type'=>'textarea'],
            ['name'=>'professional logos title','key'=>'professional-logos-title','value'=>'Thousands of Unique Logos for Your Success','type'=>'textarea'],
            ['name'=>'professional logos text','key'=>'professional-logos-text','value'=>"<p>Discover our exclusive logo collection, where each unique design is sold only once,ensuring your brand stands out. Our range of logos, crafted by world-class designers, is ideal for everyone from startups to established businesses, enhancing your brand's identity and elevating your market presence.</p><p>&nbsp;</p>",'type'=>'textarea'],
            ['name'=>'registerbanner title','key'=>'registerbanner-title','value'=>'Register to Find Your Perfect Logo','type'=>'textarea'],
            ['name'=>'register banner title desc','key'=>'register-banner-title-desc','value'=>'','type'=>'textarea'],
            ['name'=>'register banner title text desc','key'=>'register-banner-title-text-desc','value'=>"<p>Logomax is more than just a logo marketplace &ndash; it elevates Your Brand's Identity and Path to Success.</p>",'type'=>'textarea'],
            ['name'=>'customer review title','key'=>'customer-review-title','value'=>'Why our customers love Logomax','type'=>'textarea'],
            ['name'=>'customer review text','key'=>'customer-review-text','value'=>"<p>Thousands of customers have chosen Logomax to deﬁne their brand's identity. Our exclusive, one-of-a- kind logos have helped businesses of all sizes make a lasting impression. Explore their success stories and see why they trust Logomax to realize their brand vision.</p>",'type'=>'textarea'],
            ['name'=>'discover trending title','key'=>'discover-trending-title','value'=>"Discover what's Trending",'type'=>'textarea'],
            ['name'=>'meta title','key'=>'meta-title','value'=>'Logomax | Home','type'=>'textarea'],
            ['name'=>'meta description','key'=>'meta-description','value'=>'','type'=>'textarea'],
            ['name'=>'meta language','key'=>'meta-language','value'=>'en','type'=>'textarea'],
            ['name'=>'meta country','key'=>'meta-country','value'=>'','type'=>'textarea'],
        ];
        foreach($languageList as $lang_code => $lang){
            foreach($homeContent as $list_lang => $langData){
                if($lang_code == $list_lang){
                    foreach($langData as $content){
                        HomeContent::insert([
                            'name'=>$content['name'],
                            'language'=>$content['language'],
                            'lang_code'=>$content['lang_code'],
                            'key'=>$content['key'],
                            'value'=>$content['value'],
                            'type'=>$content['type'],
                        ]);
                    }
                }else{
                    foreach($defaultLangContent as $content){
                        HomeContent::insert([
                            'name'=>$content['name'],
                            'language'=> $lang,
                            'lang_code'=> $lang_code,
                            'key'=>$content['key'],
                            'value'=>$content['value'],
                            'type'=>$content['type'],
                        ]);
                    }    
                }
            }
        }
        
    }
}
