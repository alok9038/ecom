<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect(){
        if(user()->is_admin === "ADM"){
            // return redirect()->route('admin.dashboard');
        }
        elseif(session()->has('cart_redirect')){
            // echo "<script>open('$url','_self')</script>";
            session()->forget('cart_redirect');
            return redirect()->route('cart');
        }
        elseif(session()->has('redirect')){
            $url = session()->get('redirect');
            echo "<script>open('$url','_self')</script>";
            session()->forget('redirect');
        }
        else{
            return redirect()->route('homepage');
        }
    }
}
