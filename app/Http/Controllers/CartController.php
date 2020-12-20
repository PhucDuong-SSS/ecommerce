<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;


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

            $cart = Cart::content();
            return view('page.checkout',compact('cart'));

        }else{
            $notification=array(
                'messege'=>'At first Login Your Account',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.login')->with($notification);
        }

    }




}
