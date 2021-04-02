<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\product;
use App\Models\Ship_document;
class OrderController extends Controller
{
    public function orders(){
        $data['orders'] = Order_item::where([['ordered',true],['status','0']])->orderBy('id','desc')->get();
        return view('admin.orders',$data);
    }
    public function order_details($id){
        $data['print'] = Ship_document::where('order_id',$id)->first();
        $data['order'] = Order_item::where([['ordered',true],['id',$id]])->first();
        return view('admin.orders_details',$data);
    }
    public function placed_orders(){
        $data['placed_orders'] = Order_item::where([['ordered',true],['status','2']])->orderBy('id','desc')->get();
        return view('admin.placed_orders',$data);
    }

}
