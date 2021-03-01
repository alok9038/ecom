<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
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
        // if(user()->is_admin === "ADM"){
            
        // }
        // elseif(user()->is_admin === "USR"){
        //     return redirect()->route('login');
        // }
        // else{
        //     return redirect()->route('login');
        // }

        if(session()->has('ADM')){
            return $next($request);
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }else{
            session()->flush();
            return redirect()->route('login');
        }
        return $next($request);
        }
     }
