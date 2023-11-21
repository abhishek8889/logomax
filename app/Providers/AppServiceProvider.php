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
            $ipDetails = $allServices->getIpDetails($userIp);
            $userIPDetails = array();
            if($ipDetails !== null){
                $userIPDetails  = array(
                    'userTimezone' => $ipDetails->timezone,
                    'country' => $ipDetails->country,
                    'countryCode' => $ipDetails->countryCode,
                );
            }else{
                $userIPDetails  = array(
                    'userTimezone' => 'Asia/Kolkata',
                    'country' => 'India',
                    'countryCode' => 'IN',
                );
            }
            $view->with('userIPDetails', $userIPDetails);
        });
    }
}
