<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function addCart($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $product->color;
            Cart::add($data);
            $count =Cart::count();
            $subtotal =Cart::subtotal();
            return  \Response::json(['success' => 'Successfully Added on your Cart','count'=>$count,'subtotal'=>$subtotal]);
        }else{

            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $product->color;
            Cart::add($data);
            $count =Cart::count();
            $subtotal =Cart::subtotal();
            return  \Response::json(['success' => 'Successfully Added on your Cart','count'=>$count,'subtotal'=>$subtotal]);

        }

    }
    public function check(){
        $content = Cart::content();
        return response()->json($content);
    }


    public function showCart(){
        $carts = Cart::content();
        return view('page.cart',compact('carts'));
    }


    public function removeCart($rowId){
        Cart::remove($rowId);
        $notification=array(
            'messege'=>'Product Remove form Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }


    public function updateCart(Request $request){

        $rowId = $request->productid;
        $qty = $request->qty;
        Cart::update($rowId,$qty);
        $notification=array(
            'messege'=>'Product Quantity Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
    public function destroyCart()
    {
        Cart::destroy();
        return Redirect()->back();
    }

    public function checkout(){
        if (Auth::guard('customer')->check()) {
            $setting = DB::table('settings')->first();
            $shipping_charge = $this->number_unformat($setting->shipping_charge);
            $subtotal = $this->number_unformat(Cart::Subtotal());
            $cart = Cart::content();
            return view('page.checkout',compact('cart','setting','shipping_charge','subtotal'));

        }else{
            $notification=array(
                'messege'=>'At first Login Your Account',
                'alert-type'=>'success'
            );
            return Redirect()->route('customer.login')->with($notification);
        }

    }

    public function number_unformat($number, $dec_point = '.', $thousands_sep = ',')
    {
        return (float)str_replace(array($thousands_sep, $dec_point),
            array('', '.'),
            $number);
    }

    public function coupon(Request $request){
        $coupon = $request->coupon;

        $check = DB::table('coupons')->where('name',$coupon)->first();
        if ($check) {
            $subtotal =  $this->number_unformat(Cart::Subtotal());
            $discount = $this->number_unformat($check->discount);
           $balance = $subtotal - $subtotal*$discount/100;
            Session::put('coupon',[
                'name' => $check->name,
                'discount' => $check->discount,
                'balance' => $balance
            ]);
            $notification=array(
                'messege'=>'Successfully Coupon Applied',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);


        }else{
            $notification=array(
                'messege'=>'Invalid Coupon',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function couponRemove(){
        Session::forget('coupon');
        $notification=array(
            'messege'=>'Coupon remove Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }




}
