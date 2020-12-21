<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function paymentProcess(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        $setting = DB::table('settings')->first();
        $subtotal = $this->number_unformat(Cart::Subtotal());
        $shipping_charge = $this->number_unformat($setting->shipping_charge);
         $cart =Cart::content();

        if ($request->payment == 'stripe') {

            return view('page.stripe',compact('data','shipping_charge','subtotal','cart'));

        }elseif ($request->payment == 'paypal') {
            # code...
        }elseif ($request->payment == 'ideal') {
            # code...
        }else{
            echo "Cash On Delivery";
        }


    }


    public function stripeCharge(Request $request){

        $email = Auth::guard('customer')->user()->email;
        $total = $request->total;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51I0eIjE7kMXTtAnwKj4KO5KjDlhCBOSzmur44cfCC2xGtNnGehpo9zt7KcOC2CAjEzUgnad9tvwQTgS9c7Q64EQs00uvgXSIRL');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total*100,
            'currency' => 'usd',
            'description' => 'phucduong Ecommerce Details',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);
        $data = array();
        $data['customer_id'] = Auth::guard('customer')->id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['blnc_transection'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['subtotal'] = $request->subtotal;
        $data['total'] = $request->total;
        $data['vat'] = $request->vat;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);


        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);
        // Mail send to user for Invoice
//        Mail::to($email)->send(new invoiceMail($data));


        /// Insert Shipping Table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shippings')->insert($shipping);

        // Insert Order Details Table

        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty*$row->price;
            DB::table('order_details')->insert($details);

        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification = [
            'message'=>' Resquest order done',
            'alert-type'=>'success'
        ];
        return Redirect()->route('index')->with($notification);

    }



    public function SuccessList(){

        $order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(5)->get();

        return view('pages.returnorder',compact('order'));


    }


    public function RequestReturn($id){
        DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
        $notification=array(
            'messege'=>'Order Request Done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


    }
    public function number_unformat($number, $dec_point = '.', $thousands_sep = ',')
    {
        return (float)str_replace(array($thousands_sep, $dec_point),
            array('', '.'),
            $number);
    }

}
