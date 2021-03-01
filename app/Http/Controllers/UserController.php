<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Order_item;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

class UserController extends Controller
{
    Public function login(Request $req){
        if(isset($_POST['login'])){
            $contact = $req->contact;
            $password = $req->password;

            $query = User::where(['contact'=>$contact])->first();
            if($query){
                if(Hash::check($req->password, $query->password)){
                    $req->session()->put('USER_LOGIN',true);
                    $req->session()->put('USER_ID',$query->id);
                    return redirect()->back();
                }else{
                    $req->session()->flash('error','Please enter correct Password');
                    return redirect()->back();
                }

            }else{
                $req->session()->flash('error','Please ENter correct login details');
                return redirect()->back();
            }
        }
        else{
            if($req->session()->has('USER_LOGIN')){
               
                return redirect()->route('homepage');
            }
            return view('user.login');
        }
    }

    public function register(Request $request){
        if(isset($_POST['signup'])){
            $request->validate([
                'name' => 'required',
                'contact'=>'required|unique:users',
                'email'=>'required|email|unique:users',
                'password' => 'min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8'
            ]);
            $password = $request->password;
            $register = new User();
            $register->name = $request->name;
            $register->contact = $request->contact;
            $register->email = $request->email;
            $register->password =  Hash::make("$password");
            $register->save();

            Session::flash('msg','Successfully Register');

            return redirect()->route('user.login');
        }
        else{
            return view('user.register');
        }
       
    }

    public function my_orders(){
        $user =  Auth::id();
        $data['order'] = Order_item::where('user_id',$user)->orderBy('id','desc')->get();  
        return view('home.myorders',$data);
    }
    public function order_details($id){
        $user =  Auth::id();
        $data['order'] = Order_item::where([['user_id',$user],['id',$id]])->orderBy('id','desc')->first();  
        return view('home.order_details',$data);
    }
}
