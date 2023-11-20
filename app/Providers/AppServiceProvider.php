<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Services\AllServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AllServices::class, function () {
            return new AllServices();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['view']->composer('*', function ($view) {
            $allServices = $this->app->make(AllServices::class);
            $userIp = request()->ip();
            $timezone = $allServices->getTimezoneByIP($userIp);
    
            $userTimezone = ($timezone !== null) ? $timezone : 'Asia/Kolkata';
            
            $view->with('userTimezone', $userTimezone);
        });
    }
}
