<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Alert;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Order_item;

class RatingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function review($slug, $id){
        $p_id = Crypt::decryptString($id);
        $user_id = Auth::id();

        $data['rating'] = Rating::where([['product_id',$p_id],['user_id',$user_id]])->first();;
        $data['order'] = Order_item::where([['product_id',$p_id],['user_id',$user_id]])->get();
        $data['product'] = Product::where('id',$p_id)->first();
        return view('home.review_rating',$data);
    }
    public function review_rating(Request $request){
        $request->validate([
            'rating'=> 'required',
            'description'=> 'required',
        ]);
        $user_id = Auth::id();
        $product_id = $request->product_id;

        $rating = new Rating;
        $rating->ratings = $request->rating;
        $rating->review_title = $request->title;
        $rating->review_description = $request->description;
        $rating->product_id = $product_id;
        $rating->user_id = $user_id;
        $rating->save();
        
        Alert::toast('Thank you so much. Your review has been saved', 'success');
        return redirect()->route('homepage');

    }
    public function review_rating_update(Request $request){
        $user_id = Auth::id();
        $product_id = $request->product_id;

        Rating::where([['product_id',$product_id],['user_id',$user_id]])->update([
        'ratings' => $request->rating,
        'review_title' => $request->title,
        'review_description' => $request->description,
        'product_id' => $product_id,
        'user_id' => $user_id
        ]);

        Alert::toast('Thank you so much. Your review has been saved', 'success');
        return redirect()->route('homepage');

    }
}
