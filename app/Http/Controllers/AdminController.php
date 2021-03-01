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

    public function login(Request $req){
        if(isset($_POST['login'])){
            $username = $req->username;
            $password = $req->password;

            $query = Admin::where(['username'=>$username])->first();
            if($query){
                if($req->password == $query->password){
                    $req->session()->put('ADMIN_LOGIN',true);
                    $req->session()->put('ADMIN_ID',$query->id);
                    return redirect()->route('admin.dashboard');
                }else{
                    $req->session()->flash('error','Please enter correct Password');
                    return redirect()->back();
                }

            }else{
                $req->session()->flash('error','Please ENter correct login details');
                return redirect()->back();
            }
        }
        return view('admin.login');
    }
    
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
