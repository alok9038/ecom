<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category(){
        $data['categories'] = Category::all();
        return view('admin.category',$data);
    }

    public function storeCategory(Request $request){
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

        return redirect()->back();

    }

    public function drop_category($id){
        Category::where('id',$id)->delete();
        return redirect()->back();
    }

    public function category_edit(Request $request, $id){
        
        Category::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            ]);
    }
}
