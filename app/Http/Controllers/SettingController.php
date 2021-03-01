<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SettingController extends Controller
{
    public function site_settings(Request $request){
        if(isset($_POST['update_logo'])){
            $filename = time() . "." . $request->logo->extension();
            $request->logo->move(public_path("logo"),$filename);

            SiteSetting::where('id','1')->update(['logo'=>$filename]);
            
            return redirect()->back();

        }
        if(isset($_POST['update_site_name'])){
            
            $update = SiteSetting::where('id','1')->update(['site_name'=>$request->site_name]);
            return redirect()->back();
        }
        if(isset($_POST['update_color'])){
            
            SiteSetting::where('id','1')->update(['color'=>$request->color]);

            return redirect()->back();
        }
        return view('admin.settings');
    }
}
