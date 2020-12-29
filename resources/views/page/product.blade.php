@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/product_custom.js')}}"></script>
@endsection
@section('content')

    <!-- Single Product -->
    <!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{ asset( $product->image_one ) }}"><img src="{{ asset( $product->image_one ) }}" alt=""></li>
                        <li data-image="{{ asset( $product->image_two ) }}"><img src="{{ asset( $product->image_two ) }}" alt=""></li>
                        <li data-image="{{ asset( $product->image_three ) }}"><img src="{{ asset( $product->image_three ) }}" alt=""></li>
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset( $product->image_one ) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $product->brand->name }}</div>
                        <div class="product_name">{{ $product->name }}</div>
                        <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        <div class="product_text"><p>
                                {{  substr($product->details,0, 600 )  }}
                            </p></div>
                        <div class="order_info d-flex flex-row">

                            <form action="{{route('cart.addProductCart',$product->id)}}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Color</label>
                                            <select class="form-control input-lg" id="exampleFormControlSelect1" name="color"> @foreach($product_color as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Quantity</label>
                                            <input class="form-control" type="number" value="1" pattern="[0-9]" name="qty">
                                        </div>
                                    </div>



                                </div>

                        </div>


                        @if($product->discount_price == NULL)
                            <div class="product_price">${{ $product->selling_price }}<span> </div>
                        @else
                            <div class="product_price">${{ $product->discount_price }}</div>
                        @endif


                        <div class="button_container">
                            <button type="submit" class="button cart_button">Add to Cart</button>
                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                        </div>

                        <br><br>


                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">

                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_1.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_2.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_3.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_4.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_5.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_6.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_7.jpg')}}" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('frontend/images/brands_8.jpg')}}" alt=""></div></div>

                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
