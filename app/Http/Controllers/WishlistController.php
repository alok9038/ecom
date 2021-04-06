<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
use Alert;

class WishlistController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function add(Request $request){
        $user_id = $request->post('user_id');
        $product_id = $request->post('product_id');

        $check = Wishlist::where([['product_id',$product_id],['user_id',$user_id]])->get();

        if(count($check) > 0){
            echo 0;
        }else{
            $add = new Wishlist();
            $add->user_id = $request->post('user_id');
            $add->product_id = $request->post('product_id');
            $add->save();
            // return ['msg'=>"data successfully inserted"];
            echo 1;
        }

        // $input = $request->all();
        // return response()->json(['success'=>'Got Simple Product Ajax Request.']);
    }
    public function wishlist(Request $request){

        $wishlist = Wishlist::where('user_id',Auth::id())->get();

        if(count($wishlist) > 0){
            return json_encode(array('data'=>$wishlist, 'status'=>1));
        }else{
            return json_encode(array('status'=>0));
        }   
    }

    public function remove_wishlist(Request $request){
        $product_id = $request->post('product_id');
        $wishlist = Wishlist::where('product_id',$product_id)->delete();
        if($wishlist){
            echo 1;
        }
    }
}
