@extends('page.layout.app_layout')
@section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">

@endsection
@section('script')
    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>

@endsection
@section('content')

    <!-- slide -->

    <!-- product list-->
    <div class="container">
        <!-- product title-->
        @if(count($searchProducts)>0)

            <div class="row">
            <h3 style="margin: auto">Result for seach key: "{{$keyword}}"</h3>


           <div class="row ">
            @foreach($searchProducts as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid4">
                        <div class="product-image4">
                            <a href="{{route('product.showDetails',['id'=>$product->id])}}">
                                <img class="pic-1" src="{{$product->getUrl().$product->image_one}}">
                                <img class="pic-2" src="{{$product->getUrl().$product->image_two}}">
                            </a>
                            <ul class="social">
                                <li><a href="{{route('product.showDetails',['id'=>$product->id])}}" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
    {{--                            <li><a  href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>--}}
                                <li><a class="addcart" data-id="{{$product->id}}" href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            @if($product->discount_price == NULL)

                            <span class="product-new-label">New</span>
                            @else
                            <span class="product-discount-label">
                                  @php
                                      $amount = $product->selling_price - $product->discount_price;
                                      $discount = $amount/$product->selling_price*100;
                                  @endphp

                                {{ intval($discount) }}%
                            </span>
                            @endif
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{$product->name}}</a></h3>
                            <div class="price">
                                @if($product->discount_price == NULL)
                                    ${{ $product->selling_price }}
                                @else
                                    ${{$product->discount_price}}
                                <span>${{$product->selling_price}}</span>
                                    @endif
                            </div>
                            <div class="home-product-item__origin">
                                <span class="home-product-item__branch">{{$product->view}} view</span>
                                <span class="home-product-item__origin-name">{{$product->sold}} Sold</span>
                            </div>
                        </div>
                    </div>
                </div>
             @endforeach
        </div>
                @else
                    <div class="row">
                        <h3 style="margin: auto">No result for seach key: "{{$keyword}}"</h3>
                    </div>


                @endif
    </div>

    <!-- policy-->
    <div class="container">
        <div class="characteristics">
            <div class="container">
                <div class="row">

                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">

                        <div class="char_item d-flex flex-row align-items-center justify-content-start">
                            <div class="char_icon"><img src="{{asset('frontend/images/char_1.png')}}" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Free Delivery</div>
                                <div class="char_subtitle">from $50</div>
                            </div>
                        </div>
                    </div>

                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">

                        <div class="char_item d-flex flex-row align-items-center justify-content-start">
                            <div class="char_icon"><img src="{{asset('frontend/images/char_2.png')}}" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Free Delivery</div>
                                <div class="char_subtitle">from $50</div>
                            </div>
                        </div>
                    </div>

                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">

                        <div class="char_item d-flex flex-row align-items-center justify-content-start">
                            <div class="char_icon"><img src="{{asset('frontend/images/char_3.png')}}" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Free Delivery</div>
                                <div class="char_subtitle">from $50</div>
                            </div>
                        </div>
                    </div>

                    <!-- Char. Item -->
                    <div class="col-lg-3 col-md-6 char_col">

                        <div class="char_item d-flex flex-row align-items-center justify-content-start">
                            <div class="char_icon"><img src="{{asset('frontend/images/char_4.png')}}" alt=""></div>
                            <div class="char_content">
                                <div class="char_title">Free Delivery</div>
                                <div class="char_subtitle">from $50</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
