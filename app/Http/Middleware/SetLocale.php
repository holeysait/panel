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
        $locale = null;

        // 1) Prefer authenticated user's locale
        if ($request->user() && in_array($request->user()->locale, ['ru','en'])) {
            $locale = $request->user()->locale;
        }

        // 2) Fallback to session
        if (!$locale && $request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
        }

        // 3) Fallback to app default
        if (!$locale) {
            $locale = config('app.locale', 'en');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
