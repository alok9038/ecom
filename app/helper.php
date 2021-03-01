<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Order_item;
use App\Models\Category;
use App\Models\SiteSetting;
// Use Session;

if(!function_exists('user')){
    function user(){
        $id = Auth::id();
        $user = User::where('id',$id)->first();

        return $user;
    }
}
if(!function_exists('cart_count')){
    function cart_count(){
        $id = Auth::user()->id;
        $cart = Order_item::where([['user_id',$id],['ordered',false]])->get();    
        $cart_count = count($cart);
        return $cart_count;
    }
}
if(!function_exists('category')){
    function category(){
        $category = Category::all();
        return $category;
    }
}
if(!function_exists('site')){
    function site(){
        $site = SiteSetting::first();
        return $site;
    }
}

?>