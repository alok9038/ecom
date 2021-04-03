<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\product;
use App\Models\Ship_document;
use Auth;
class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function orders(){
        if(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['orders'] = Order_item::where([['ordered',true],['status','0']])->orderBy('id','desc')->get();
        return view('admin.orders',$data);
    }
    public function order_details($id){
        if(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['print'] = Ship_document::where('order_id',$id)->first();
        $data['order'] = Order_item::where([['ordered',true],['id',$id]])->first();
        return view('admin.orders_details',$data);
    }
    public function placed_orders(){
        if(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['placed_orders'] = Order_item::where([['ordered',true],['status','2']])->orderBy('id','desc')->get();
        return view('admin.placed_orders',$data);
    }

}
