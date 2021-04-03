<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Order_item;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function my_orders(){
        $user =  Auth::id();
        $data['order'] = Order_item::where('user_id',$user)->orderBy('id','desc')->get();  
        return view('home.myorders',$data);
    }
    public function order_details($id){
        $user =  Auth::id();
        $data['order'] = Order_item::where([['user_id',$user],['id',$id]])->orderBy('id','desc')->first();  
        return view('home.order_details',$data);
    }
}
