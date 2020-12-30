@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/category_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>
    <script>
        $( document ).ready(function() {
            /*-------------------
            Quantity change
        --------------------- */
            var proQty = $('.pro-qty');
            proQty.prepend('<span class="dec qtybtn">-</span>');
            proQty.append('<span class="inc qtybtn">+</span>');
            proQty.on('click', '.qtybtn', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find('input').val(newVal);
            });
        });

    </script>
@endsection
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumb-wrap">
                <div class="breadcrumb">
                    <ul class="breadcrumbs-view d-flex flex-row" >
                        <li><a class="breadcrumbs-view__link" href="{{route('index')}}">Home</a></li>
                        <li><a class="breadcrumbs-view__link" href="">Cart</a></li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <form action="{{route('cart.updateCart')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $row)

                        <tr>
                            <td class="cart__product__item">
                                <img width="50px" src="{{"https://phucduongc8.s3.amazonaws.com/".$row->options->image}}" alt="" >
                                <div class="cart__product__item__title">
                                    <h6>{{$row->name}}</h6>
                                    <div class="rating">
                                        <span>Color: {{$row->options->color}}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="cart__price">$ {{$row->price}}</td>
                            <td class="cart__quantity">
                                <div class="pro-qty">
                                    <input name="qty[]" type="text" value="{{$row->qty}}">
                                </div>
                                <input type="hidden" name="productid[]" value="{{$row->rowId}}" >

                            </td>
                            <td class="cart__total">$  {{ $row->price*$row->qty }}</td>

                            <td class="cart__close">
                                <a  href="{{ route('cart.removeCart', $row->rowId) }}"><span>X</span></a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="#">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <button class="site-btn" type="submit"><span class="icon_loading"></span> Update</button>
                </div>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    @if(Session::has('coupon'))

                    @else
                    <h6>Discount codes</h6>
                    <form action="{{route('cart.addCoupon')}}" method="post">
                          @csrf
                        <input name="coupon" type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                        @endif
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>${{  Cart::Subtotal() }}</span></li>
                        @if(Session::has('coupon'))
                            <li>Coupon code <span>$ {{ Session::get('coupon')['name'] }}</span></li>
                            <li>Coupon code <span>(- {{ Session::get('coupon')['discount'] }}% ) <a href="{{ route('cart.couponRemove') }}" class="btn btn-danger btn-sm">X</a></span></li>
                        @else
                        @endif
                          <li>Shipping <span>$ {{ $shipping_charge}}</span></li>
                        @if(Session::has('coupon'))
                             <li>Vat <span>$ {{$vat = Session::get('coupon')['balance']*10/100}}</span></li>
                        @else
                            <li>Vat <span>$ {{$subtotal*0.1}}</span></li>

                        @endif

                        @if(Session::has('coupon'))
                        <li>Total <span>$ {{ Session::get('coupon')['balance']*1.1  +$shipping_charge }} </span></li>
                        @else
                            <li>Total <span>$ {{ $subtotal*1.1 +$shipping_charge  }} </span></li>

                        @endif
                    </ul>
                    <a href="{{route('cart.showPaymentPage')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

