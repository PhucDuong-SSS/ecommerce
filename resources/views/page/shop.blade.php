@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">
@endsection
@section('script')
    <script src="{{ asset('frontend/js/shop_custom.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on( 'scroll',function(){
                let routeRender = '{{route('product.showrecently')}}';
                checkRenderProduct = false;
             if($(window).scrollTop()>400 && checkRenderProduct === false)
             {
                 checkRenderProduct = true;
                let products = localStorage.getItem('products');
                products = $.parseJSON(products);
                if(products.length >0)
                {
                    $.ajax({
                       url: routeRender,
                        method: "POST",
                        data: {id:products},
                        success: function (result)
                        {
                            console.log(result.data);
                            $("#render").html('').append(result.data);

                        }

                    });
                }
             }
            });
        });

    </script>

@endsection
@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">Category Product</h2>
        </div>
    </div>

    <!-- Shop -->

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar">
                        <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @foreach($categories as $category)
                                <li><a href="{{route('product.showProductCategory',$category->id)}}">{{$category->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="sidebar_section filter_by_section">
                            <div class="sidebar_title">Filter By</div>
                            <div class="sidebar_subtitle">Price</div>
                            <div class="filter_price">
                                <div id="slider-range" class="slider_range"></div>
                                <p>Range: </p>
                                <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                            </div>
                        </div>
                        <div class="sidebar_section">
                            <div class="sidebar_subtitle color_subtitle">Color</div>
                            <ul class="colors_list">
                                <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                                <li class="color"><a href="#" style="background: #000000;"></a></li>
                                <li class="color"><a href="#" style="background: #999999;"></a></li>
                                <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                                <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                                <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                            </ul>
                        </div>
                        <div class="sidebar_section">
                            <div class="sidebar_subtitle brands_subtitle">Brands</div>
                            <ul class="brands_list">
                                @foreach($brands as $brand)
                                <li class="brand"><a href="#">{{$brand->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{count($productsCategory)}}</span> products found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                        <ul>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                            <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid">
                            <div class="product_grid_border"></div>

                            <!-- Product Item -->
                            @foreach($productsCategory as $product)
                                <div class="product_item is_new" id="content_product" data-id="{{$product->id}}">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($product->image_one) }}" alt="" style="height: 100px; width: 100px;"></div>
                                    <div class="product_content">

                                        @if($product->discount_price == NULL)
                                            <div class="product_price discount">${{ $product->selling_price }}<span> </div>
                                        @else
                                            <div class="product_price discount">${{ $product->discount_price }}<span>${{ $product->selling_price }}</span></div>
                                        @endif

                                        <div class="product_name"><div><a href="" tabindex="0">{{ $product->product_name  }} </a></div></div>
                                    </div>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>


                                    <ul class="product_marks">
                                        @if($product->discount_price == NULL)
                                            <li class="product_mark product_new" style="background: blue;">New</li>
                                        @else
                                            <li class="product_mark product_new" style="background: red;">
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = $amount/$product->selling_price*100;

                                                @endphp

                                                {{ intval($discount) }}%

                                            </li>
                                        @endif
                                    </ul>
                                </div>

                            @endforeach


                        </div>

                        <!-- Shop Page Navigation -->

                        <div class="shop_page_nav d-flex flex-row">
                            {{$productsCategory->links("pagination::bootstrap-4")}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->
    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Recently Viewed</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            <!-- Recently Viewed Item -->
                            <span id="render"></span>



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

                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_1.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_2.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_3.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_4.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_5.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_6.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_7.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_8.jpg" alt=""></div></div>

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
