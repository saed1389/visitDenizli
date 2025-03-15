<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the locale is set in the session
        if ($request->session()->has('locale')) {
            App::setLocale($request->session()->get('locale'));
        } else {
            // Get the browser's preferred language from the Accept-Language header
            $browserLang = $request->getPreferredLanguage(['tr', 'en']);

            // Set the locale based on the browser's preferred language
            $locale = in_array($browserLang, ['tr', 'en']) ? $browserLang : 'en'; // Default to 'en' if unsupported
            App::setLocale($locale);

            // Optionally, store the detected language in the session
            $request->session()->put('locale', $locale);
        }

        return $next($request);
    }
}
