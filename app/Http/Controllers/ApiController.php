<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seshac\Shiprocket\Shiprocket;

class ApiController extends Controller
{
    public function check(){
        $token =  Shiprocket::getToken();//  if you added credentials at shiprocket.php config
    }
}
