<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    public function site_settings(Request $request){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        if(isset($_POST['update_logo'])){
            $filename = time() . "." . $request->logo->extension();
            $request->logo->move(public_path("logo"),$filename);

            SiteSetting::where('id','1')->update(['logo'=>$filename]);
            
            return redirect()->back();

        }
        if(isset($_POST['update_site_name'])){
            if(Auth::check() == false){
                Alert::toast('Login First!', 'warning');
                return redirect()->route('login');
            }elseif(Auth::user()->is_admin == "USR"){
                Alert::toast('Access Denied!', 'error');
                return redirect()->back();
            }
            
            $update = SiteSetting::where('id','1')->update(['site_name'=>$request->site_name]);
            return redirect()->back();
        }
        if(isset($_POST['update_color'])){
            if(Auth::check() == false){
                Alert::toast('Login First!', 'warning');
                return redirect()->route('login');
            }elseif(Auth::user()->is_admin == "USR"){
                Alert::toast('Access Denied!', 'error');
                return redirect()->back();
            }
            
            SiteSetting::where('id','1')->update(['color'=>$request->color]);

            return redirect()->back();
        }
        return view('admin.settings');
    }
}
