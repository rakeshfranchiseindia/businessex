<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireProfileAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            return $next($request);
        }

        $profileUrl = url($request->path());
        $request->session()->put('profile_intended_url', $profileUrl);

        return redirect()->to($profileUrl)->with('auth_required', true);
    }
}
