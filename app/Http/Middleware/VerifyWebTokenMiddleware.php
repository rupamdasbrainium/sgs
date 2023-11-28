<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class VerifyWebTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = getClientToken();
        if ($token == "unauthorised" || $token==401) {
            return redirect()->route('login')->withErrors(['user', trans('auth.expired')]);
        }
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
