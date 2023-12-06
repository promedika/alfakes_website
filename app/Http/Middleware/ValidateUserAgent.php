<?php

namespace App\Http\Middleware;

use Closure;

class ValidateUserAgent
{
    public function handle($request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');

        // Validasi User-Agent hanya untuk Android dan iOS
        if (strpos($userAgent, 'Android') === false && strpos($userAgent, 'iPhone') === false) {
            return redirect()->back()->with('message', 'Login hanya dapat dilakukan melalui aplikasi Android dan iOS.');
        }

        return $next($request);
    }
}
