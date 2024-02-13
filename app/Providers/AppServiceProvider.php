<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Services\AllServices;
use App\Models\Categories;
use App\Models\Style;
use App\Models\Branch;
use Illuminate\Support\Facades\View;


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

            // $allCategory = Categories::all();
            // $allStyles = Style::all();
            // $allBranches = Branch::all();
            $siteLanguagesList = array(
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
            $view->with('userIPDetails', $userIPDetails);
            // $view->with('siteLanguagesList', $siteLanguagesList);

            // Share the data with the view
        View::share('siteLanguagesList', $siteLanguagesList);
        });
    }
}
