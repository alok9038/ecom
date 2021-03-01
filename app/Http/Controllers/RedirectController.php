<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect(){
        
        if(session()->has('cart_redirect')){
            // echo "<script>open('$url','_self')</script>";
            session()->forget('cart_redirect');
            return redirect()->route('cart');
        }
        if(session()->has('redirect')){
            $url = session()->get('redirect');
            echo "<script>open('$url','_self')</script>";
            session()->forget('redirect');
        }
        else{
            return redirect()->route('homepage');
        }
    }
}
