<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us_contents')->truncate();
        $about_data = [
            [
                'name' => 'Upper Text Title',
                'key' => 'upper-text-title',
                'value' => '',
                'type' => 'textarea',
            ],
            [
                'name' => 'Upper Text Left',
                'key' => 'upper-text-left',
                'value' => "<h2>About Logomax</h2><p><em>Unveiling Unique Identities, One Logo at a Time</em></p><p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetitive and overused logos, we stand out by oﬀering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it's the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you're a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>",
                'type' => 'textarea',
            ],
            [
                'name' => 'Upper Text Right',
                'key' => 'upper-text-right',
                'value' => "<h2>Our Vision</h2><p><em>Crafting Distinctive Brands with Exclusive Designs</em></p><p>Our vision at Logomax is simple yet profound - to empower businesses with the ability to own a distinctive piece of art that sets them apart. With Logomax, when you buy a logo, you're not just making a purchase; you're claiming exclusivity. You become the sole owner of a design that can deﬁne your brand for years to come.</p><p>We specialize in two tiers of logos - Low-priced Logos and Premium Logos, catering to a wide range of budgets without compromising on the uniqueness and quality of designs. Our categories, including Leter Mark Logos, Pictorial Mark Logos, Abstract Logos, Emblem Logos, Dynamic Logos, Minimalistic Logos, Geometric Logos and Combination Logos, ensure that you ﬁnd a logo that resonates with your brand's ethos eﬀortlessly.</p>",
                'type' => 'textarea',
            ],
            [
                'name' => 'video image',
                'key' => 'video-image',
                'value' => '2023-11-09_102227_video-img.png',
                'type' => 'file',
            ],
            [
                'name' => 'video link',
                'key' => 'video-link',
                'value' => 'https://www.youtube.com/embed/M2kSJbLbIgQ',
                'type' => 'link',
            ],

            [
                'name' => 'Contact Us',
                'key' => 'contact-us',
                'value' => '<h2>Contact Us</h2><p>Send us your questions, comments, or suggestions and we will address them as quickly as possible. You can also check out our Help Center. Have another question? Contact us and we will get back to you as quickly as possible</p>',
                'type' => 'textarea',
                
            ],
            [
                'name' => 'video Text Title',
                'key' => 'video-text-title',
                'value' => ' <h2>Who we are</h2>',
                'type' => 'textarea',
            ],
            [
                'name' => 'video Text',
                'key' => 'video-text',
                'value' => '<h2>Our Commitment</h2><p>Ensuring Satisfaction with Every Logo Story</p>',
                'type' => 'textarea',
            ],
            [
                'name' => 'Join Us Image',
                'key' => 'join-us-image',
                'value' => '2023-11-09_133334_signup-bg 1.png',
                'type' => 'file',
            ],
            [
                'name' => 'Join Us',
                'key' => 'join-us',
                'value' => "<h2>Want to work with us?</h2><p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that's truly your own.</p>",
                'type' => 'textarea',
            ],
            [
                'name' => 'Facebook link',
                'key' => 'facebook-link',
                'value' => '#',
                'type' => 'link',
            ],
            [
                'name' => 'Instagram link',
                'key' => 'instagram-link',
                'value' => '#',
                'type' => 'link',
            ],
            [
                'name' => 'Pinterest link',
                'key' => 'pinterest-link',
                'value' => '#',
                'type' => 'link',
            ],
            [
                'name' => 'Linked In link',
                'key' => 'linked-in-link',
                'value' => '#',
                'type' => 'link',
            ],
            [
            'name'=>'meta title',
            'key'=>'meta-title',
            'value'=>'Logomax | About Us',
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
            DB::table('about_us_contents')->insert([
                'name' => $data['name'],
                'key' => $data['key'],
                'value' => $data['value'],
                'type' => $data['type'],
            ]);
        }

    }
}
