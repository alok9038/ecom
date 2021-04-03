<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Alert;
use Auth;

class CategoryController extends Controller
{
    public function category(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data['categories'] = Category::all();
        return view('admin.category',$data);
    }

    public function storeCategory(Request $request){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $request->validate([
            'title'          => 'required',
            'description'    => 'required',
            'image'          => 'required',
        ]);

        $filename = time() . "." . $request->image->extension();
        $request->image->move(public_path("category"),$filename);
        $slug = Str::of($request->title)->slug('-');

        $category = new Category();
        $category->cat_title = $request->title;
        $category->description = $request->description;
        $category->color = $request->color;
        $category->image = $filename;
        $category->slug = $slug;
        $category->save();
        Alert::toast('Category Successfully Inserted!', 'success');
        return redirect()->back();

    }

    public function drop_category($id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $delete = Category::where('id',$id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = true;
            $message = "User not found";
        }
        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
        Alert::toast('Category Successfully Removed!', 'Toast Type');
        return redirect()->back();
        
    }

    public function category_edit(Request $request, $id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        
        Category::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            ]);
    }
}
