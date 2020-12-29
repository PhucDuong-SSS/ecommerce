@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/cart_custom.js')}}"></script>
@endsection
@section('content')

    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach($carts as $row)
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="{{$row->options->image}}" style="width: 70px; width: 70px;" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{substr($row->name,0,35)}}</div>
                                        </div>
                                        <div class="cart_item_color cart_info_col">
                                            @if($row->options->color == null)
                                            @else
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text">{{$row->options->color}}</div>
                                            @endif
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <form method="post" action="{{ route('cart.updateCart') }}">
                                                @csrf
                                                <input type="hidden" name="productid" value="{{ $row->rowId }}">
                                                <input type="number" name="qty" value="{{ $row->qty }}" style="width: 50px;">
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i> </button>

                                            </form>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">{{$row->price}}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text">{{$row->price * $row->qty}}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Action</div><br>
                                            <a href="{{ route('cart.removeCart', $row->rowId ) }}" class="btn btn-sm btn-danger">x</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <a href="{{route('cart.destroyCart')}}"><button type="button" class="button cart_button_clear">All Cancel</button></a>
                            <a href="{{route('cart.checkout')}}"><button type="button" class="button cart_button_checkout">Checkout</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
