<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserRole::class);
        $this->call(LogoStatus::class);
        $this->call(SiteMetaKeys::class);
        $this->call(SupportContent::class);
        $this->call(AboutUsContent::class);
        $this->call(HomeContentSeeder::class);
        $this->call(BlogContent::class);
        $this->call(LoginContent::class);
        $this->call(RegisterContent::class);
        $this->call(ReviewContent::class);
        $this->call(ShopContent::class);
    }
}
