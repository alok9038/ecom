<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function add(Request $request){
        // $user_id = $request->post('user_id');
        // $product_id = $request->post('product_id');

        // $check = Wishlist::where([['product_id','$product_id'],['user_id',$user_id]])->get();

        // if(count($check) > 0){
        //     return ['msg'=>"Already exists"];
        // }else{
            $add = new Wishlist();
            $add->user_id = $request->post('user_id');
            $add->product_id = $request->post('product_id');
            $add->save();
            // return ['msg'=>"data successfully inserted"];
        // }

        $input = $request->all();
        return response()->json(['success'=>'Got Simple Product Ajax Request.']);
    }
}
