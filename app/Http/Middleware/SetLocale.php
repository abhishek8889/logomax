<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next){
        $locale = $request->segment(1);
        $locale2 = $request->segment(2);
        if($locale !== 'changelagnuage' || $locale2 !== 'changelagnuage'){
            if (in_array($locale, config('app.available_locales'))) {
                App::setLocale($locale);
            }
        }
        return $next($request);
    }
}
