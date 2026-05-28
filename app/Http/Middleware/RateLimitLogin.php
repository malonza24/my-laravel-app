<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class RateLimitLogin
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            Log::warning('Too many login attempts', [
                'ip' => $request->ip(),
                'email' => $request->input('email'),
                'retry_after' => $seconds,
            ]);

            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($key, 300); // 5 minutes lockout

        return $next($request);
    }

    public function clear(Request $request)
    {
        RateLimiter::clear('login:' . $request->ip());
    }
}