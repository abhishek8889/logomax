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
                'value' => '<h2>Our mission&nbsp;</h2>',
                'type' => 'textarea',
            ],
            [
                'name' => 'Upper Text Left',
                'key' => 'upper-text-left',
                'value' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'type' => 'textarea',
            ],
            [
                'name' => 'Upper Text Right',
                'key' => 'upper-text-right',
                'value' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
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
                'value' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
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
                'value' => '<h2>Want to work with us?</h2><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.</p>',
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
