<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Support\Facades\Auth;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $token = null;

        if (! $response instanceof SymfonyResponse) {
            $response = new Response($response);
        }

        if (Auth::user()) {
            $token = Auth::user()->api_token;
        }

        $response->headers->set('Set-Cookie', 'API-TOKEN='.$token);

        return $response;
    }
}
