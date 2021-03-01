<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Http\Middleware\AuthAdmin;
class AdminAuth
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
        if(session('is_admin') === 'ADM'){
            return $next($request);
        }
        else{
            session()->flush();
            return redirect()->route('login');
        }
            return $next($request);
        }
     }
