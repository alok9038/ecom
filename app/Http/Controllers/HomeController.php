<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order_item;
use Auth;
use App\Models\user;
use View;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    
    
    public function index(){
        $data['items'] = Order_item::where([['user_id',Auth::id()],['ordered',false]])->get();
        $data['products']= Product::orderBy('id','desc')->get();
        return view('home.index',$data);
    }
    public function product($name){
        $data['s_products'] = Product::where('slug !',$name);
        $data['product'] = Product::where('slug',$name)->first();
        return view('home.product',$data);
    }


    public function filter($name){
        $cat = Category::where('slug',$name)->get();
        $data['products'] = Product::where('cat_id',$cat[0]->id)->get();
        return view('home.filter',$data);
    }
    
    
}
