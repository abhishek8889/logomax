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
            ['name'=>'register background image','key'=>'register-background-image','value'=>'1_1699516775.png','type'=>'image'],
            ['name'=>'unique logos from text','key'=>'unique-logos-from-text','value'=>'<h5>Unique logos from            <span>$149</span>          </h5>','type'=>'textarea'],
            ['name'=>'professional logos title','key'=>'professional-logos-title','value'=>'Thousands of Professional Logo Templates','type'=>'textarea'],
            ['name'=>'professional logos text','key'=>'professional-logos-text','value'=>"<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>",'type'=>'textarea'],
            ['name'=>'registerbanner title','key'=>'registerbanner-title','value'=>'Register to download Logos from Logomax.','type'=>'textarea'],
            ['name'=>'register banner title desc','key'=>'register-banner-title-desc','value'=>'What is <br> Lorem Ipsum?','type'=>'textarea'],
            ['name'=>'register banner title text desc','key'=>'register-banner-title-text-desc','value'=>"<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.",'type'=>'textarea'],
            ['name'=>'customer review title','key'=>'customer-review-title','value'=>'Why our customers love Logomax','type'=>'textarea'],
            ['name'=>'customer review text','key'=>'customer-review-text','value'=>'<p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and grow a brand they love.</p>','type'=>'textarea'],
            ['name'=>'discover trending title','key'=>'discover-trending-title','value'=>"Discover what's Trending",'type'=>'textarea'],
            ['name'=>'meta title','key'=>'meta-title','value'=>'test','type'=>'textarea'],
            ['name'=>'meta description','key'=>'meta-description','value'=>'','type'=>'textarea'],
            ['name'=>'meta language','key'=>'meta-language','value'=>'test','type'=>'textarea'],
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
