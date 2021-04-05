<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paytm;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Order;
use App\Models\Address;
use PaytmWallet;
use Auth;
use Illuminate\Support\Facades\Crypt;


class PaytmController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function paytmcallback()
    {
        $user_id  = Auth::id();

        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();
        
        $order_id = $transaction->getOrderId(); // return a order id
      
        $transaction->getTransactionId(); // return a transaction id

        $split = explode('_', $order_id);
        $orders_id = $split[2];
        $o_id =Crypt::encryptString($orders_id);
    
        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {
            Paytm::where('order_id', $order_id)->update(['status' => 1, 'transaction_id' => $transaction->getTransactionId()]);

            Order::where(['ordered'=>false],['user_id'=>$user_id],['id',$o_id])->update(['ordered'=>true]);
            Order_item::where(['ordered'=>false],['user_id'=>$user_id],['id',$o_id])->update(['ordered'=>true]);
            
            return redirect()->route('order.placed',['id'=>$o_id]);

        } else if ($transaction->isFailed()) {
            Paytm::where('order_id', $order_id)->update(['status' => 0, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is failed.");
            
        } else if ($transaction->isOpen()) {
            Paytm::where('order_id', $order_id)->update(['status' => 2, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is processing.");
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        
        // $transaction->getOrderId(); // Get order id
    }


    public function pay($id)
    {
        $o_id = Crypt::decryptString($id);
        $user_id = Auth::id();
        $order_item = Order_item::where(['ordered'=>false],['user_id'=>$user_id],['order_id',$o_id])->get();
        $order = Order::where(['ordered'=>false],['user_id'=>$user_id],['id',$o_id])->first();

        $amount= 0;
        // echo $order->coup->amount;        
        if($order->coupon != "") {
            foreach($order_item as $i){
                $amount+= $i->items->discount_price*$i->qty;
            }
            $amount = $amount - $order->coup->amount;
        }
        else{
            foreach($order_item as $i){
                $amount+= $i->items->discount_price*$i->qty;
            }
            $amount;
        } 

        $mobile = $order->add->contact;

        $userData = [
            'name' => $order->add->name, // Name of user
            'mobile' =>$mobile, //Mobile number of user
            'email' => $order->add->email, //Email of user
            'fee' => $amount,
            'order_id' => $mobile."_".rand(1,1000)."_".$o_id //Order id
        ];

        $paytmuser = Paytm::create($userData); // creates a new database record

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $userData['order_id'], 
            'user' => $user_id,
            'mobile_number' => $userData['mobile'],
            'email' => $userData['email'], // your user email address
            'amount' => $amount, // amount will be paid in INR.
            'callback_url' => route('paytm.callback') // callback URL
        ]);
        return $payment->receive();  // initiate a new payment
    }

    /*public function paytmCallback()
    {
        $transaction = PaytmWallet::with('receive');
        
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        
        if($transaction->isSuccessful()){
          //Transaction Successful
          return view('paytm-success-page');
        }else if($transaction->isFailed()){
          //Transaction Failed
          return view('paytm-fail');
        }else if($transaction->isOpen()){
          //Transaction Open/Processing
          return view('paytm-fail');
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
        //get important parameters via public methods
        $transaction->getOrderId(); // Get order id
        $transaction->getTransactionId(); // Get transaction id
    }*/

    public function paytmPurchase()
    {
        return view('paytm');
    } 
}
