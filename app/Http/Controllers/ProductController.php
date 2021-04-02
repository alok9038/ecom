<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{
    public function insert(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['category'] = Category::all();
        return view('admin.insertproduct',$data);
    }

    public function insertProduct(Request $request){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $request->validate([
            'title'          => 'required',
            'price'          => 'required',
            'discount_price' => 'required',
            'description'    => 'required',
            'cover_image'    => 'required',
            'category'       => 'required'
        ]);


        
        $images = $request->file('images');
        if ($request->hasFile('images')) :
                foreach ($images as $item):
                    $var = date_create();
                    $time = date_format($var, 'YmdHis');
                    // $imageName = time() . "." . $item->extension();
                    // $item->move(public_path("product"),$imageName);

                    $imageName = $time . '-' . $item->getClientOriginalName();
                    $item->move(public_path("product"), $imageName);
                    $arr[] = $imageName;
                endforeach;
                
            $image = implode(",", $arr);
        else:
            $image = '';
        endif;


        $filename = time() . "." . $request->cover_image->extension();
        $request->cover_image->move(public_path("product"),$filename);

        $slug = Str::of($request->title)->slug('-');
        

        $product = new Product();
        $product->title             =       $request->title;
        $product->price             =       $request->price;
        $product->discount_price    =       $request->discount_price;
        $product->description       =       $request->description;
        $product->model             =       $request->model;
        $product->brand             =       $request->brand;
        $product->cat_id            =       $request->category;
        $product->cover_image       =       $filename;
        $product->slug              =       $slug;
        $product->images            =       $image;
        $product->save();

        return redirect()->route('products.view');
    }

    public function products(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['products'] = Product::orderBy('id','desc')->get();
        return view('admin.manage_product',$data);
    }
    

    public function dropProduct($id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        Product::where('id',$id)->delete();
        return redirect()->back();
    }
}
