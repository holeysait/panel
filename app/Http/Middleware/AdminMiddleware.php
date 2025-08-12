<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        if (!($user->is_admin ?? false)) {
            abort(403, 'Admin only');
        }
        return $next($request);
    }
}
