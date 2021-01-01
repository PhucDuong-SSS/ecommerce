<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;


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
        $categories = Category::all();
        $siteSetting = DB::table('site_settings')->get();
        return view('page.cart',compact('carts','siteSetting','categories'));
    }


    public function removeCart($rowId){
        Cart::remove($rowId);
        $notification = [
            'message'=>'Successfully removed',
            'alert-type'=>'success'
        ];
        return Redirect()->back()->with($notification);

    }


    public function updateCart(Request $request){

        $ArrId = $request->productid;
        $quantity = $request->qty;
        foreach ($ArrId as $keyId=>$rowId){

            foreach ($quantity as $keyQty=>$qty ){
                if($keyId == $keyQty){
                    Cart::update($rowId,['qty'=>$qty]);
                }
            }
        }
        $notification = [
            'message'=>'Successfully updated',
            'alert-type'=>'success'
        ];
        return Redirect()->back()->with($notification);

    }
    public function destroyCart()
    {
        Cart::destroy();
        return Redirect()->back();
    }

    public function checkout(){
        if (Auth::guard('customer')->check()) {
            $categories = Category::all();
            $siteSetting = DB::table('site_settings')->get();

            $setting = DB::table('settings')->first();
            $shipping_charge = $this->number_unformat($setting->shipping_charge);
            $subtotal = $this->number_unformat(Cart::Subtotal());
            $cart = Cart::content();
            return view('page.checkout',compact('cart','setting','shipping_charge','subtotal','categories','siteSetting'));

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
    public function showPaymentPage()
    {
        $categories = Category::all();
        $siteSetting = DB::table('site_settings')->get();
        $customer =Auth::guard('customer')->user();
        $setting = DB::table('settings')->first();
        $cart = Cart::content();
        $subtotal = $this->number_unformat(Cart::Subtotal());
        $shipping_charge = $this->number_unformat($setting->shipping_charge);

        return view('page.paymentpage',compact('cart','shipping_charge', 'subtotal','customer','siteSetting','categories') );
    }

    public function addProductCart( Request  $request,$id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            Cart::add($data);
            $count =Cart::count();
            $subtotal =Cart::subtotal();
            $notification=array(
                'messege'=>'Product add Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{

            $data['id'] = $product->id;
            $data['name'] = $product->name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            Cart::add($data);
            $count =Cart::count();
            $subtotal =Cart::subtotal();
            $notification=array(
                'messege'=>'Product add Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }

    }



}
