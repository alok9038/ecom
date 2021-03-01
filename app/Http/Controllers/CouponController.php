<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function store_coupon(Request $req){
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
        $data['coupons'] = Coupon::all();
        return view('admin.coupon',$data);
    }

    public function drop_coupon($id){
        Coupon::where('id',$id)->delete();
        return redirect()->back();
    }
    public function coupon_status(Request $req, $id){
        if(isset($_POST['deactive'])){
            Coupon::where('id',$id)->update(['status'=>0]);
        }
        elseif(isset($_POST['active'])){
            Coupon::where('id',$id)->update(['status'=>1]);
        }
        
        return redirect()->back();
    }
}
