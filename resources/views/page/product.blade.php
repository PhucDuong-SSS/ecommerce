@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/category_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>
@endsection
@section('content')

    <!-- Single Product -->
    <!-- Single Product -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumb-wrap">
                <div class="breadcrumb">
                    <ul class="breadcrumbs-view d-flex flex-row" >
                        <li><a class="breadcrumbs-view__link" href="{{route('index')}}">Home</a></li>
                            <li><a class="breadcrumbs-view__link" href="{{route('product.showProductCategory',['id'=>$product->category->id])}}">{{$product->category->name}}</a></li>
                            <li><a class="breadcrumbs-view__link" href="{{route('product.showProductSubCategory',['id'=>$product->sub_category->id])}}">{{$product->sub_category->name}}</a></li>
                    </ul>

                </div>

            </div>
        </div>

    </div>

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{$product->getUrl().$product->image_one}}"><img src="{{$product->getUrl().$product->image_one}}" alt=""></li>
                        <li data-image="{{$product->getUrl().$product->image_two}}"><img src="{{$product->getUrl().$product->image_two}}" alt=""></li>
                        <li data-image="{{$product->getUrl().$product->image_three}}"><img src="{{$product->getUrl().$product->image_three}}" alt=""></li>
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{$product->getUrl().$product->image_one}}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
{{--                        <div class="product_category">{{ $product->brand->name }}</div>--}}
                        <div class="product_name">{{ $product->name }}</div>
                        <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        <div class="product_text"><p>
                                {!! $product->details !!}
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

    <!-- product list-->
    <div class="container">
        <!-- product title-->

        <div class="row">
            <div class="col col-lg-12">
                <div class="product-wap d-flex flex-row align-items-start justify-content-between">
                    <!-- navbar title-->
                    <div class="block-product__menu d-flex flex-row ">
                        <h2 class="block-product__menu-title"><a href="">Relate</a></h2>

                    </div>





                </div>
            </div>

        </div>
        <div class="row ">
            @if(count($productRelated))
            @foreach($productRelated as $product)
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
                @endif



        </div>
    </div>


@endsection
