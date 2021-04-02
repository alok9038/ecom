<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function list(){
        return  Product::all();
    }
    public function product($id){
        return  Product::where('id',$id)->first();
    }
}
