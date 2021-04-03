<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public function coup(){
         
        return $this->hasOne('App\Models\Coupon','id','coupon');
    }
    public function add(){
        return $this->hasOne('App\Models\Address','id','address');
    }
    
}
