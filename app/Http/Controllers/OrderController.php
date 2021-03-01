<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\product;
class OrderController extends Controller
{
    public function orders(){
        $data['orders'] = Order_item::where('ordered',true)->orderBy('id','desc')->get();
        return view('admin.orders',$data);
    }
    public function order_details($id){
        $data['order'] = Order_item::where([['ordered',true],['id',$id]])->first();
        return view('admin.orders_details',$data);
    }

}
