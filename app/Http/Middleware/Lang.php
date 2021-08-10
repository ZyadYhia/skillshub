<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->session()->get('lang');
        // if ($lang == null) {
        //     $lang = 'en';
        // }
        //null coalescing operator
        $lang = $lang ?? "en";
        App::setLocale($lang);
        return $next($request);
    }
}
