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
        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();
        
        $order_id = $transaction->getOrderId(); // return a order id
      
        $transaction->getTransactionId(); // return a transaction id

        $o_id =Crypt::encryptString($order_id);
    
        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {
            Paytm::where('order_id', $order_id)->update(['status' => 1, 'transaction_id' => $transaction->getTransactionId()]);
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
        $user =  Auth::id();
        $order= Order_item::where([['user_id',$user],['ordered',true],['order_id',$id]])->get();      
        
        // echo $order->items->price;
        $amount= 0;   foreach($order as $i){
            $amount+= $i->items->discount_price*$i->qty;
        }   
        $userData = [
            'name' =>  $i->orders->add->name,// Name of user
            'mobile' => $i->orders->add->contact, //Mobile number of user
            'email' => $i->orders->add->email, //Email of user
            'fee' => $amount,
            'order_id' => $id //Order id
        ];

        $paytmuser = Paytm::create($userData); // creates a new database record

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $id,
            'user' => $user,
            'mobile_number' => $i->orders->add->contact,
            'email' => $i->orders->add->email,
            'amount' => $amount,
            'callback_url' => route('paytm.callback')
          ]);
        return $payment->receive();
        
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
