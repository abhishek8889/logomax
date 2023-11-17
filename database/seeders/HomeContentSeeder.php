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
            ['id'=>1,'name'=>'register background image','key'=>'register-background-image','value'=>'1_1699516775.png','type'=>'image'],
            ['id'=>2,'name'=>'unique logos from text','key'=>'unique-logos-from-text','value'=>'<h5>Unique logos from            <span>$149</span>          </h5>','type'=>'textarea'],
            ['id'=>3,'name'=>'professional logos title','key'=>'professional-logos-title','value'=>'Thousands of Professional Logo Templates','type'=>'textarea'],
            ['id'=>4,'name'=>'professional logos text','key'=>'professional-logos-text','value'=>"<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>",'type'=>'textarea'],
            ['id'=>5,'name'=>'registerbanner title','key'=>'registerbanner-title','value'=>'Register to download Logos from Logomax.','type'=>'textarea'],
            ['id'=>6,'name'=>'register banner title desc','key'=>'register-banner-title-desc','value'=>'What is <br> Lorem Ipsum?','type'=>'textarea'],
            ['id'=>7,'name'=>'register banner title text desc','key'=>'register-banner-title-text-desc','value'=>"<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.",'type'=>'textarea'],
            ['id'=>8,'name'=>'customer review title','key'=>'customer-review-title','value'=>'Why our customers love Logomax','type'=>'textarea'],
            ['id'=>9,'name'=>'customer review text','key'=>'customer-review-text','value'=>'<p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and grow a brand they love.</p>','type'=>'textarea'],
            ['id'=>10,'name'=>'meta title','key'=>'meta-title','value'=>'test','type'=>'textarea'],
            ['id'=>11,'name'=>'meta description','key'=>'meta-description','value'=>'','type'=>'textarea'],
            ['id'=>12,'name'=>'meta language','key'=>'meta-language','value'=>'test','type'=>'textarea'],
            ['id'=>13,'name'=>'meta country','key'=>'meta-country','value'=>'','type'=>'textarea'],
        ];

        foreach($homeContent as $content){
            HomeContent::insert([
                'id'=>$content['id'],
                'name'=>$content['name'],
                'key'=>$content['key'],
                'value'=>$content['value'],
                'type'=>$content['type'],
            ]);
        }
        
    }
}
