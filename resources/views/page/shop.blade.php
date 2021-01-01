@extends('page.layout.app_layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/category_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/shop_responsive.css')}}">
@endsection
@section('script')
    <script src="{{asset('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>

    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>

@endsection
@section('content')
    <!-- slide -->
    <div class="blog">

        <div class="container">
            <div class="slide">
                <div class="sidebar">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>


                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img
                                    src="{{asset('frontend/images/sl1.png')}}"
                                    class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('frontend/images/sl2.png')}}"
                                     class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('frontend/images/sl3.jpg')}}"
                                     class="d-block w-100" alt="...">
                            </div>

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumb-wrap">
                <div class="breadcrumb">
                    <ul class="breadcrumbs-view d-flex flex-row" >
                        <li><a class="breadcrumbs-view__link" href="{{route('index')}}">Home</a></li>
                        @if(count($productsCategory)>0)
                        <li><a class="breadcrumbs-view__link" href="{{route('product.showProductCategory',['id'=>$productsCategory[0]->category->id])}}">{{$productsCategory[0]->category->name}}</a></li>
                        @endif
                    </ul>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="sidenav">
                    @if(count($productsCategory)>0)
                    <a href="{{route('product.showProductCategoryFeature',['categoryId'=>$productsCategory[0]->category->id])}}">Hot deal</a>
                    <a href="{{route('product.showProductCategoryTrend',['categoryId'=>$productsCategory[0]->category->id])}}">Trend</a>
                    <a href="{{route('product.showProductCategoryView',['categoryId'=>$productsCategory[0]->category->id])}}">Hight view</a>
                    <button class="dropdown-btn">Sorf by
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="{{route('product.showProductCategoryPriceAsc',['categoryId'=>$productsCategory[0]->category->id])}}">Price(Low>Hight)</a>
                        <a href="{{route('product.showProductCategoryPriceDecs',['categoryId'=>$productsCategory[0]->category->id])}}">Price(Hight>Low)</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div class="row ">
                    @if(count($productsCategory))
                    @foreach($productsCategory as $product)
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
                    @else
                        <h3 style="margin: auto" >Chưa có sản phẩm</h3>
                        @endif

                </div>


                </div>

            </div>
        </div>
    </div>


@endsection
