<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSuperadmin
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
        $superAdminRole = Role::where('name','superadmin')->first();
        if (Auth::user()->role_id !== $superAdminRole->id) {
            return redirect(url(''));
        }
        return $next($request);
    }
}
