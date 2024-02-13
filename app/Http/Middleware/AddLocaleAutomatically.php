<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddLocaleAutomatically
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get')) {
            if(!$request->route('locale')) {
                // Get the default locale from your configuration or wherever it is stored
                $defaultLocale = config('app.locale', 'en-us');
                // Redirect to the same URL with the default locale added
                return redirect('/' . $defaultLocale . $request->getRequestUri());
            }
        }

        return $next($request);
    }
}
