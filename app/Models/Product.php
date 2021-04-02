<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_item;
class Product extends Model
{
    use HasFactory;
    public function cat(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    static public function GetAllProducts($ParaMeter){
        if(isset($ParaMeter['id']) && $ParaMeter['id']>=0){
            $Product = Product::where('cat_id',$ParaMeter['id'])->get();
            return $Product;
        }
    }
    static public function CountProducts($ParaMeter){
        if(isset($ParaMeter['CategoryId']) && $ParaMeter['CategoryId']>=0){
            $Product = Product::where('cat_id',$ParaMeter['CategoryId'])->get();
            return $Product;
        }
    }
}
