<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$level)
    {
        // $user = User::where('level',$request);
        if (in_array($request->user()->level,$level)) {
            return $next($request);
        }
        // return redirect('/login');
        return redirect('/');
    }
}
