<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\User;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Session;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function addToCart($id){
        $count = Product::where('id',$id)->get();
        $user =  Auth::id();
        if(count($count) > 0){
            $order = Order::where([['user_id',$user],['ordered',false]])->get();
            if(count($order) > 0){
                $cond = [['ordered',false],['user_id',$user],['order_id',$order[0]->id],['product_id',$id]];
                $order_item = Order_item::where($cond)->get();

                if(count($order_item) > 0){
                    $qty = $order_item[0]->qty+=1;
                    Order_item::where($cond)->update(['qty'=>$qty]);
                }
                else{
                    Order_item::insert([
                        'ordered' => false,
                        'user_id' => $user,
                        'order_id' => $order[0]->id,
                        'qty' => 1,
                        'product_id' => $id
                    ]);
                    
                }
            }
            else{
                $order = new Order;
                $order->ordered = false;
                $order->user_id = $user;
                $order->coupon  = null;
                $order->address = null;
                $order->save();
                echo $last_id = $order->id;

                $orderitem = Order_item::insert([
                    "ordered"=>false,
                    "user_id"=>$user,
                    "order_id"=>$last_id,
                    'product_id'=>$id
                    ]);

                // $this->session->set_flashdata('msg', 'Item successfully added to cart');

            }
            return redirect()->route('cart');
        }
        
    }

    public function cart(){
        $user =  Auth::id();
        $data['items'] = Order_item::where([['user_id',$user],['ordered',false]])->get();        
        $data['order'] = Order::where([['user_id',$user],['ordered',false]])->first();        
        return view('home.cart',$data);
    }
    public function coupon(Request $req, $id = null){
        $order_id = $req->order_id;
        $coupon = $req->code;

        // remove coupon
        if($id!= null){
            $query = Order::where('id',$id)->update([
                'coupon' => null
                ]);
                return redirect()->back();
        }
        else{
            echo "<script>alert('Something Went Wrong')</script>";
        }

        // add coupon
        $check = Coupon::where(['code',$coupon],['status'=> 1])->get();
        if(count($check) == 0){
            echo "<script>alert('coupon code not valid')</script>";
            //return redirect()->back();
        }else{
            $query = Order::where('id',$order_id)->update([
                'coupon' => $check[0]->id,
                ]);
                return redirect()->back();
        }
        
    }

    public function orders(){
        $user = Auth::id();
        // count cart items

        $data['order'] = Order_item::where([['user_id',$user],['ordered',true]])->get();
        
        return view('home.orders',$data);
    }

    public function minus($id){
       
        $user = Auth::id();
        $item = Product::where('id',$id)->get();
        
        if(count($item) > 0){
            $order = Order::where([['user_id',$user],['ordered',false]])->get();
            if(count($order) > 0){
                // if exist
                $cond = [['ordered',false],['user_id',$user],['order_id',$order[0]->id],['product_id',$id]];
                $order_item = Order_item::where($cond)->get();

                if($order_item[0]->qty > 1){
                    $qty = $order_item[0]->qty-=1;
                    Order_item::where($cond)->update(['qty'=>$qty]);
                }
                else{
                    Order_item::where($cond)->delete();
                }
                return redirect()->back();
            }
            
        }
        
    }
    
    public function remove_item($id){
        $user = Auth::id();;
        $order = Order::where([['user_id',$user],['ordered',false]])->get();
        $cond = [['ordered',false],['user_id',$user],['order_id',$order[0]->id],['product_id',$id]];
        Order_item::where($cond)->delete();

        return redirect()->back();
    }

    public function address(Request $req){
        $user_id = Auth::id();;

        if(!empty($req->address)){
            $address_id = $req->address;
            Order::where(['ordered'=>false],['user_id'=>$user_id])->update(['address'=>$address_id, 'user_id'=>$user_id, 'ordered'=>true]);
            Order_item::where(['ordered'=>false],['user_id'=>$user_id])->update(['user_id'=>$user_id, 'ordered'=>true]);
            $order = Order::where(['ordered'=>true],['user_id'=>$user_id])->orderBy('updated_at','desc')->first();
            $order_id =   Crypt::encryptString($order->id);
            return redirect()->route('order.placed',['id'=>$order_id]);
        }else{
            $req->validate([
                'name' => 'required',
                'contact' => 'required',
                'street' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'state' => 'required',
                'pincode' => 'required|size:6',
                'landmark' => 'required'
            ]);

            
            $add = new Address;
            $add->name = $req->name;
            $add->street = $req->street;
            $add->city = $req->city;
            $add->pincode = $req->pincode;
            $add->contact = $req->contact;
            $add->state = $req->state;
            $add->pincode = $req->pincode;
            $add->landmark = $req->landmark;
            $add->user_id = $user_id;
            $add->save();
            echo $last_id = $add->id;

            // $order = Order::where(['ordered'=>true],['user_id'=>$user_id])->orderBy('updated_at','desc')->first();
            $order = Order::where(['ordered'=>false],['user_id'=>$user_id])->update(['address'=>$last_id, 'user_id'=>$user_id, 'ordered'=>true]);
            Order_item::where(['ordered'=>false],['user_id'=>$user_id],['order_id'=>$order->id])->update(['user_id'=>$user_id, 'ordered'=>true]);
            $order_id =Crypt::encryptString($order->id);
            return redirect()->route('order.placed',['id'=>$order_id]);

        }
        return redirect()->route('order.placed');
    }

    public function checkout(){
        $u_id = Auth::id();
        $order = Order_item::where([['user_id',$u_id],['ordered',false]])->first();
        if(empty($order)){
            return redirect()->route('cart');
        }
        else{
            $data['user'] = User::where(['id'=>$u_id])->first();
            $data['address'] = Address::where('user_id',$u_id)->get();

            return view('home.checkout',$data);
        }
        

    }

    public function login(){
        return view('user.login');
    }

    public function order($id){
        $id = Crypt::decryptString($id);
        $user =  Auth::id();
        $data['order'] = Order_item::where([['user_id',$user],['ordered',true],['order_id',$id]])->get();        
        return view('home.order_placed',$data);
    }

}