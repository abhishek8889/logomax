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
        
        $about_data = [
            'en-us' =>[
                [
                    'name' => 'Upper Text Title',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'upper-text-title',
                    'value' => '',
                    'type' => 'textarea',
                ],
                [
                    'name' => 'Upper Text Left',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'upper-text-left',
                    'value' => "<h2>About Logomax</h2><p><em>Unveiling Unique Identities, One Logo at a Time</em></p><p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetitive and overused logos, we stand out by oﬀering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it's the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you're a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>",
                    'type' => 'textarea',
                ],
                [
                    'name' => 'Upper Text Right',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'upper-text-right',
                    'value' => "<h2>Our Vision</h2><p><em>Crafting Distinctive Brands with Exclusive Designs</em></p><p>Our vision at Logomax is simple yet profound - to empower businesses with the ability to own a distinctive piece of art that sets them apart. With Logomax, when you buy a logo, you're not just making a purchase; you're claiming exclusivity. You become the sole owner of a design that can deﬁne your brand for years to come.</p><p>We specialize in two tiers of logos - Low-priced Logos and Premium Logos, catering to a wide range of budgets without compromising on the uniqueness and quality of designs. Our categories, including Leter Mark Logos, Pictorial Mark Logos, Abstract Logos, Emblem Logos, Dynamic Logos, Minimalistic Logos, Geometric Logos and Combination Logos, ensure that you ﬁnd a logo that resonates with your brand's ethos eﬀortlessly.</p>",
                    'type' => 'textarea',
                ],
                [
                    'name' => 'video image',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'video-image',
                    'value' => '2023-11-09_102227_video-img.png',
                    'type' => 'file',
                ],
                [
                    'name' => 'video link',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'video-link',
                    'value' => 'https://www.youtube.com/embed/M2kSJbLbIgQ',
                    'type' => 'link',
                ],

                [
                    'name' => 'Contact Us',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'contact-us',
                    'value' => '<h2>Contact Us</h2><p>Send us your questions, comments, or suggestions and we will address them as quickly as possible. You can also check out our Help Center. Have another question? Contact us and we will get back to you as quickly as possible</p>',
                    'type' => 'textarea',
                    
                ],
                [
                    'name' => 'video Text Title',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'video-text-title',
                    'value' => '<h2>Our Commitment</h2><p>Ensuring Satisfaction with Every Logo Story</p>',
                    'type' => 'textarea',
                ],
                [
                    'name' => 'video Text',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'video-text',
                    'value' => "<p>Your journey to an iconic brand identity is paramount to us. At Logomax, we<br>ensure that every interaction is seamless, from browsing to purchasing your<br>exclusive logo. Our dedicated support team is always on standby to assist, making<br>your experience smooth and enjoyable.</p><p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that's truly your own.</p>",
                    'type' => 'textarea',
                ],
                [
                    'name' => 'Join Us Image',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'join-us-image',
                    'value' => '2023-11-09_133334_signup-bg 1.png',
                    'type' => 'file',
                ],
                [
                    'name' => 'Join Us',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'join-us',
                    'value' => "<h2>Want to work with us?</h2><p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that's truly your own.</p>",
                    'type' => 'textarea',
                ],
                [
                    'name' => 'Facebook link',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'facebook-link',
                    'value' => '#',
                    'type' => 'link',
                ],
                [
                    'name' => 'Instagram link',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'instagram-link',
                    'value' => '#',
                    'type' => 'link',
                ],
                [
                    'name' => 'Pinterest link',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'pinterest-link',
                    'value' => '#',
                    'type' => 'link',
                ],
                [
                    'name' => 'Linked In link',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key' => 'linked-in-link',
                    'value' => '#',
                    'type' => 'link',
                ],
                [
                    'name'=>'meta title',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key'=>'meta-title',
                    'value'=>'Logomax | About Us',
                    'type'=>'textarea'
                ],
                [
                    'name'=>'meta description',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key'=>'meta-description',
                    'value'=>'',
                    'type'=>'textarea'
                ],
                [
                    'name'=>'meta language',
                    'language' => 'United States - English',
                    'lang_code' => 'en-us',
                    'key'=>'meta-language',
                    'value'=>'en',
                    'type'=>'textarea'
                ],
                [
                'name'=>'meta country',
                'language' => 'United States - English',
                'lang_code' => 'en-us',
                'key'=>'meta-country',
                'value'=>'',
                'type'=>'textarea'
                ]
            ]
        ];

        $defaultLangContent = [
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
                'value' => '<h2>Our Commitment</h2><p>Ensuring Satisfaction with Every Logo Story</p>',
                'type' => 'textarea',
            ],
            [
                'name' => 'video Text',
                'key' => 'video-text',
                'value' => "<p>Your journey to an iconic brand identity is paramount to us. At Logomax, we<br>ensure that every interaction is seamless, from browsing to purchasing your<br>exclusive logo. Our dedicated support team is always on standby to assist, making<br>your experience smooth and enjoyable.</p><p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that's truly your own.</p>",
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
            ]
        ];
       
        foreach($languageList as $lang_code => $lang){
            foreach($about_data as $list_lang => $langData){
                if($lang_code == $list_lang){
                    foreach($langData as $content){
                        DB::table('about_us_contents')->insert([
                            'name' => $content['name'],
                            'language'=>$content['language'],
                            'lang_code'=>$content['lang_code'],
                            'key' => $content['key'],
                            'value' => $content['value'],
                            'type' => $content['type'],
                        ]);
                    }
                }else{
                    foreach($defaultLangContent as $content){
                        DB::table('about_us_contents')->insert([
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
