<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Shiprocket_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ShipController extends Controller
{
    public function check_requirement(Request $request, $id){
        $this->validate_token(); 
            
            $t = Shiprocket_token::first();    
            $token = $t->token;
            if(isset($_POST['place_order'])){
                if($_POST['update_order_status'] == 2){
                    Order_item::where('id',$id)->update([
                        'status'=>'2',
                        'length'=>$request->length,
                        'height'=>$request->height,
                        'width'=>$request->width,
                        'weight'=>$request->weight,
                    ]);
                    $this->place_order($token, $id);
                }
                elseif($_POST['update_order_status'] == 3){
                    Order_item::where('id',$id)->update(['status'=>'3']);
                    $this->cancel_order($token, $id);
                }
                return redirect()->back();
            }
            if(isset($_POST['cancel_order'])){
                Order_item::where('ship_order_id',$id)->update(['status'=>'3']);
                $this->cancel_order($token, $id);
            }
        return redirect()->back();
        
    }
    public function validate_token(){
        date_default_timezone_set('Asia/Kolkata');
        $row = Shiprocket_token::first();
        $added_on = strtotime($row->created_at); echo "<br>";
        $current_time = strtotime(date('Y-m-d h:i:s')); echo "<br>";
        $diff_time = $current_time - $added_on;
             if($diff_time > 86400){
                $token = $this->generate_token();
             }else{
                $token = $row->token;
             }
        return $token;

    }

    
    public function generate_token(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"email\": \"alokroy1884@gmail.com\",\n    \"password\": \"qwertyalok@123\"\n}",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);
        $token = $SR_login_Response_out->{'token'};

        date_default_timezone_set('Asia/Kolkata'); 
        $added_on = date('Y-m-d h:i:s');
        
        Shiprocket_token::where('id','1')->update(['token'=>$token, 'created_at'=>$added_on]);


    }
    
    public function place_order($token, $id){
        $order_item = Order_item::where('id',$id)->first();
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{"order_id": "'.$id.'",
        "order_date": "'.$order_item->created_at.'",
        "pickup_location": "purnia",
        "billing_customer_name": "'.$order_item->orders->add->name.'",
        "billing_last_name": "",
        "billing_address": "'.$order_item->orders->add->street.'",
        "billing_address_2": "'.$order_item->orders->add->landmark.'",
        "billing_city": "'.$order_item->orders->add->city.'",
        "billing_pincode": "'.$order_item->orders->add->pincode.'",
        "billing_state": "'.$order_item->orders->add->state.'",
        "billing_country": "India",
        "billing_email": "alok@gmail.com",
        "billing_phone": "'.$order_item->orders->add->contact.'",
        "shipping_is_billing": true,
        "shipping_customer_name": "",
        "shipping_last_name": "",
        "shipping_address": "",
        "shipping_address_2": "",
        "shipping_city": "",
        "shipping_pincode": "",
        "shipping_country": "",
        "shipping_state": "",
        "shipping_email": "",
        "shipping_phone": "",
        "order_items": [
            {
            "name": "'.$order_item->items->title.'",
            "sku": "'.$order_item->items->cat->cat_title.'",
            "units": '.$order_item->qty.',
            "selling_price": "'.$order_item->items->discount_price.'",
            "discount": "",
            "tax": "",
            "hsn": 441122
            }
        ],
        "payment_method": "Prepaid",
        "shipping_charges": 0,
        "giftwrap_charges": 0,
        "transaction_charges": 0,
        "total_discount": 0,
        "sub_total": '.$order_item->items->discount_price * $order_item->qty.',
        "length": '.$order_item->length.',
        "breadth": '.$order_item->width.',
        "height": '.$order_item->height.',
        "weight": '.$order_item->weight.'
            }',
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        $SR_login_Response_out = json_decode($SR_login_Response);

        echo "<pre>";
        print_r($SR_login_Response);
        echo "<pre>";
        print_r($SR_login_Response_out);

        $ship_order_id = $SR_login_Response_out->order_id;
        $shipment_id = $SR_login_Response_out->shipment_id;

        DB::table('order_items')->where('id',$id)->update([
            'shipment_id' => $shipment_id,
            'ship_order_id' => $ship_order_id
        ]);
    }

    public function track(){
        $t = Shiprocket_token::first();    
            echo $token = $t->token;
            
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/91833405",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTPGET  => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token"
            ),
        ));
        $SR_login_Response = curl_exec($curl);
        curl_close($curl);
        //$SR_login_Response_out = json_decode($SR_login_Response);
        echo '<pre>';
        print_r($SR_login_Response);
    }

    public function cancel_order($token, $id){
        // $t = Shiprocket_token::first();    
        // $token = $t->token;
         

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{"ids": ['.$id.']}',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
                ),
            ));
            $SR_login_Response = curl_exec($curl);
            curl_close($curl);
            $SR_login_Response_out = json_decode($SR_login_Response);
    
            echo "<pre>";
            print_r($SR_login_Response);
            echo "<pre>";
            print_r($SR_login_Response_out);
    }
}
