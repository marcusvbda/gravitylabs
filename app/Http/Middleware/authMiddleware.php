<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class authMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $oldUrl = $request->fullUrl();
        $redirectTo = route('auth.login', ['redirectTo' => $oldUrl]);
        if (!Auth::check()) {
            return redirect($redirectTo);
        }
        return $next($request);
    }
}
