@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/category_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>
@endsection
@section('content')

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-md-12 breadcrumb-wrap">
                    <div class="breadcrumb">
                        <ul class="breadcrumbs-view d-flex flex-row" >
                            <li><a class="breadcrumbs-view__link" href="">Home</a></li>
                            <li><a class="breadcrumbs-view__link" href="">Iphone</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Shop Cart Section Begin -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="{{route('payment.paymentProcess')}}" method="post" class="checkout__form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Full Name <span>*</span></p>
                                    <input type="text" name="name" value="{{$customer->name}}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input name="phone" type="text" value="{{$customer->phone}}">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <input name="address" type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>City <span>*</span></p>
                                    <input name="city" type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input name="email" type="email" value="{{$customer->email}}">
                                </div>
                            </div>


                            <div class="col-lg-12">

                                <div class="checkout__form__input">
                                    <p>Oder notes <span>*</span></p>
                                    <input name="note" type="text" placeholder="Note about your order, e.g, special noe for delivery">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    @foreach($cart as $key => $row)
                                    <li>{{$row->name}} <span>$ {{$row->price}}</span></li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Subtotal <span>$ {{ $subtotal }}</span></li>
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }} ">

                                    <li>Shipping <span>$ {{ $shipping_charge}}</span></li>
                                    <input type="hidden" name="shipping" value="{{ $shipping_charge }} ">


                                @if(Session::has('coupon'))
                                        <li>Coupon Code <span>{{ Session::get('coupon')['name'] }}</span></li>
                                        <li>Coupon discount <span>(- {{ Session::get('coupon')['discount'] }}% ) <a href="{{ route('cart.couponRemove') }}" class="btn btn-danger btn-sm">X</a> </span></li>
                                        <li>Vat <span>$ {{$vat = Session::get('coupon')['balance']*10/100}}</span></li>
                                        <input type="hidden" name="vat" value="{{ $vat }} ">

                                        <li>Total <span>$ {{$total = Session::get('coupon')['balance']*1.1  +$shipping_charge }} </span></li>
                                        <input type="hidden" name="total" value="{{ $total }} ">

                                    @else
                                        <li>Vat <span>$  {{ $vat = $subtotal*0.1}}</span></li>
                                        <input type="hidden" name="vat" value="{{ $vat }} ">

                                        <li>Total <span>$ {{$total= $subtotal*1.1 +$shipping_charge  }}</span></li>
                                        <input type="hidden" name="total" value="{{ $total }} ">

                                    @endif
                                </ul>
                            </div>
                            <div class="checkout__order__widget">

                                <label for="check-payment">
                                    COD
                                    <input value="cod" type="radio" name="payment" id="check-payment">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="paypal">
                                    Master Card
                                    <input value="stripe" type="radio" name="payment" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <button type="submit" class="site-btn">Place oder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->


@endsection

