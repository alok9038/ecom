<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seshac\Shiprocket\Shiprocket;
use App\Models\Order_item;
use App\Models\Ship_document;
class ShiprocketController extends Controller
{
    public function create(Request $request,$id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
         
        $length = $_POST['length'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $weight = $_POST['weight'];
        
        $order_item = Order_item::where('id',$id)->first();
        $orderDetails = [
            "order_id"=> $id,
            "order_date"=> $order_item->created_at,
            "pickup_location"=> "purnia",
            "billing_customer_name"=> $order_item->orders->add->name,
            "billing_last_name"=> "",
            "billing_address"=> $order_item->orders->add->street,
            "billing_address_2"=> $order_item->orders->add->landmark,
            "billing_city"=> $order_item->orders->add->city,
            "billing_pincode"=> $order_item->orders->add->pincode,
            "billing_state"=> $order_item->orders->add->state,
            "billing_country"=> "India",
            "billing_email"=> $order_item->orders->add->email,
            "billing_phone"=> $order_item->orders->add->contact,
            "shipping_is_billing"=> true,
            "shipping_customer_name"=> "",
            "shipping_last_name"=> "",
            "shipping_address"=> "",
            "shipping_address_2"=> "",
            "shipping_city"=> "",
            "shipping_pincode"=> "",
            "shipping_country"=> "",
            "shipping_state"=> "",
            "shipping_email"=> "",
            "shipping_phone"=> "",
            "order_items"=> [
                
                ["name"=> $order_item->items->title,
                "sku"=> $order_item->items->cat->cat_title,
                "units"=> $order_item->qty,
                "selling_price"=> $order_item->items->discount_price,
                "discount"=> "",
                "tax"=> "",
                "hsn"=> 441122
                ],
            ],
            "payment_method"=> "Prepaid",
            "shipping_charges"=> 0,
            "giftwrap_charges"=> 0,
            "transaction_charges"=> 0,
            "total_discount"=> 0,
            "sub_total"=> $order_item->items->discount_price * $order_item->qty,
            "length"=> $length,
            "breadth"=> $width,
            "height"=> $height,
            "weight"=> $weight
        ];

        $token =  Shiprocket::getToken();
        $response =  Shiprocket::order($token)->create($orderDetails);
        
        $shipment_id =  $response['shipment_id'];
        $order_id =  $response['order_id'];

        Order_item::where('id',$id)->update([
            'shipment_id' => $shipment_id,
            'ship_order_id' => $order_id,
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'width' => $width,
            'status' => '2',
        ]);
        
        // generate Invoice
        $orderId = [ 'ids' => [$order_id] ];
        $response1 = Shiprocket::generate($token)->invoice($orderId);

        print_r($response1);
        $invoice_url = $response1['invoice_url'];

        Ship_document::where('order_id',$id)->updateOrInsert([
            'invoice_url' => $invoice_url,
            'order_id' => $id
        ]);

        Session()->flash('message', 'Order Sucessfully Added For shipping');
        return redirect()->back();
    }

    public function cancel_order($id){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $ids = ['ids'=> [$id]]; 
        $token =  Shiprocket::getToken();
        $response =  Shiprocket::order($token)->cancel($ids);

        Order_item::where('ship_order_id',$id)->update(['status'=>'3']);
        session()->flash('success','Order Successfully Cancelled!');
        return redirect()->back();
    }

    public function track(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $shipmentId = 92241161;
        $token =  Shiprocket::getToken();
        
        
        $response =  Shiprocket::track($token)->throwShipmentId($shipmentId);
        $shipments = Shiprocket::shipment($token)->getSpecific($shipmentId);
        echo "<pre>";
        print_r($response);
        echo "<pre>";
        print_r($shipments);
        
    }

    public function generate_awb(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $data = [
            'shipment_id' => '92241161',
            'status' => '1'
        ];
        $token =  Shiprocket::getToken();
        $response =  Shiprocket::courier($token)->generateAWB($data);
        // for more details visit above url
        print_r($response);
    }
    public function check(){
        if(Auth::check() == false){
            Alert::toast('Login First!', 'warning');
            return redirect()->route('login');
        }elseif(Auth::user()->is_admin == "USR"){
            Alert::toast('Access Denied!', 'error');
            return redirect()->back();
        }
        $pincodeDetails = [
            'pickup_postcode' => '854301',
            'delivery_postcode' => '854301',
            'cod' => '0',
            'weight' => '1',
        ];
        $token =  Shiprocket::getToken();
        $response =  Shiprocket::courier($token)->checkServiceability($pincodeDetails);
        echo "<pre>";
        print_r($response);
    
    }
}
