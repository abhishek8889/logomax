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
        $homeContent = [
            ['name'=>'register background image','key'=>'register-background-image','value'=>'','type'=>'image'],
            ['name'=>'unique logos from text','key'=>'unique-logos-from-text','value'=>'<h5>Unique logos from <span>$149</span> </h5>','type'=>'textarea'],
            ['name'=>'professional logos title','key'=>'professional-logos-title','value'=>'Thousands of Unique & Exclusive Logo Designs','type'=>'textarea'],
            ['name'=>'professional logos text','key'=>'professional-logos-text','value'=>"<p>Explore our exclusive collection where each logo is sold only once, guaranteeing you a unique design that<br>becomes a symbol of your brand's identity. Created by a global network of designers, our range oﬀers<br>diverse styles and themes, perfect for startups, growing businesses, or established brands.</p>",'type'=>'textarea'],
            ['name'=>'registerbanner title','key'=>'registerbanner-title','value'=>'Register to Find Your Perfect Logo','type'=>'textarea'],
            ['name'=>'register banner title desc','key'=>'register-banner-title-desc','value'=>'Why Choose Logomax?','type'=>'textarea'],
            ['name'=>'register banner title text desc','key'=>'register-banner-title-text-desc','value'=>"<p>Logomax is more than just a logo marketplace &ndash; it's a gateway to defining your brand's identity. Each logo in our collection is an original masterpiece, created with care and creativity by talented designers. When you choose Logomax, you're not just picking a logo; you're selecting a unique design that represents your brand's story and vision.</p>",'type'=>'textarea'],
            ['name'=>'customer review title','key'=>'customer-review-title','value'=>'Why our customers love Logomax','type'=>'textarea'],
            ['name'=>'customer review text','key'=>'customer-review-text','value'=>"<p>Thousands of customers have chosen Logomax to deﬁne their brand's identity. Our exclusive, one-of-a-kind logos have helped businesses of all sizes make a lasting impression. Discover their experiences and learn why they trust Logomax to bring their brand vision to life.</p>",'type'=>'textarea'],
            ['name'=>'discover trending title','key'=>'discover-trending-title','value'=>"Discover what's Trending",'type'=>'textarea'],
            ['name'=>'meta title','key'=>'meta-title','value'=>'Logomax | Home','type'=>'textarea'],
            ['name'=>'meta description','key'=>'meta-description','value'=>'','type'=>'textarea'],
            ['name'=>'meta language','key'=>'meta-language','value'=>'en','type'=>'textarea'],
            ['name'=>'meta country','key'=>'meta-country','value'=>'','type'=>'textarea'],
        ];

        foreach($homeContent as $content){
            HomeContent::insert([
                'name'=>$content['name'],
                'key'=>$content['key'],
                'value'=>$content['value'],
                'type'=>$content['type'],
            ]);
        }
        
    }
}
