<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public function coupon(){
         
        return $this->hasOne('App\Models\Coupon','id','coupon_id');
    }
    public function add(){
        return $this->hasOne('App\Models\Address','id','address');
    }
    
}
