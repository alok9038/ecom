<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Auth;

class CouponController extends Controller
{
    public function store_coupon(Request $req){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $req->validate([
            'code' => 'required',
            'amount' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->code = $req->code;
        $coupon->amount = $req->amount;
        $coupon->save();

        return redirect()->back();
    }

    public function coupon(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['coupons'] = Coupon::all();
        return view('admin.coupon',$data);
    }

    public function drop_coupon($id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        Coupon::where('id',$id)->delete();
        return redirect()->back();
    }
    public function coupon_status(Request $req, $id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        if(isset($_POST['deactive'])){
            Coupon::where('id',$id)->update(['status'=>0]);
        }
        elseif(isset($_POST['active'])){
            Coupon::where('id',$id)->update(['status'=>1]);
        }
        
        return redirect()->back();
    }
}
