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
}
