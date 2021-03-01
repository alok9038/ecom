<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order_item;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    
    public function index(){
        $data['products'] = Product::count();
        $data['category'] = Category::count();
        $data['coupon'] = Coupon::count();
        $data['orders'] = Order_item::count();
        $data['new_order'] = Order_item::where('status','0')->count();
        $data['cancelled_orders'] = Order_item::where('status','3')->count();
        return view('admin.index',$data);
    }

    


}
