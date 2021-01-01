
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>OneClick</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/slick-1.8.0/slick.css')}}">


@yield('css')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/main_styles.css') }}">--}}

    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


    <script src="https://js.stripe.com/v3/"></script>

</head>

<body>


<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('frontend/images/phone.png')}}" alt=""></div>{{$siteSetting[0]->phone_one}}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('frontend/images/mail.png')}}" alt=""></div><a href="mailto:phucngocduong@gmail.com">phucngocduong@gmail.com</a></div>
                        <div class="top_bar_content ml-auto">
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="#">VietNamese</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            <div class="top_bar_user">
                                @if(!\Illuminate\Support\Facades\Auth::guard('customer')->check())
                                    <div class="user_icon"><img src="{{asset('frontend/images/user.svg')}}" alt=""></div>
                                    <div><a href="{{route('customer.showFormRegister')}}">Register</a></div>
                                    <div><a href="{{route('customer.showFormLogin')}}">Sign in</a></div>
                                @else

                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="#"><div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div> {{\Illuminate\Support\Facades\Auth::guard('customer')->user()->username}}<i class="fas fa-chevron-down"></i></a>
                                            <ul>
{{--                                                <li><a href="">Wishlist</a></li>--}}
                                                <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main -->

        <div class="header_main">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href="{{route('index')}}">Ishop</a></div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form method="post" action="{{route('product.searchProduct')}}" class="header_search_form clearfix">
                                        @csrf
                                        <input type="search" name="search" required="required" class="header_search_input" placeholder="Search for name products...">
                                        <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('frontend/images/search.png')}}" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
{{--                                <div class="wishlist_icon"><img src="{{asset('frontend/images/heart.png')}}" alt=""></div>--}}
                                <div class="wishlist_content">
{{--                                    <div class="wishlist_text"><a href="#">Wishlist</a></div>--}}
{{--                                    <div class="wishlist_count"><span id="wishlist">{{\Illuminate\Support\Facades\Session::get('count')}}</span></div>--}}
                                </div>
                            </div>

                            <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon">
                                        <img src="{{asset('frontend/images/cart.png')}}" alt="">
                                        <div class="cart_count"><span id="count">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="{{route('cart.checkout')}}">Cart</a></div>
                                        <div class="cart_price"><span id="subtotal">{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->

        <nav class="main_nav">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="main_nav_content d-flex flex-row">

                            <!-- Categories Menu -->

                            <div class="cat_menu_container">
                                <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                                    <div class="cat_burger"><span></span><span></span><span></span></div>
                                    <div class="cat_menu_text">categories</div>
                                </div>


                                <ul class="cat_menu">
                                    @if(count($categories))
                                        @foreach($categories as $category)
                                    <li class="hassubs">


                                        <a href="{{route('product.showProductCategory',['id'=>$category->id])}}">{{$category->name}}<i class="fas fa-chevron-right"></i></a>
                                        <ul>
                                            @foreach($category->sub_categories as $sub)

                                            <li>
                                                <a href="{{route('product.showProductSubCategory',['id'=>$sub->id])}}">{{$sub->name}}<i class="fas fa-chevron-right"></i></a>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </li>

                                        @endforeach
                                    @endif

                                </ul>
                            </div>

                            <!-- Main Nav Menu -->

                            <div class="main_nav_menu ml-auto">
                                <ul class="standard_dropdown main_nav_dropdown">
                                    <li><a href="{{route('index')}}">Home<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="{{route('product.showProductCategory',['id'=>$categories[0]->id])}}">Shop<i class="fas fa-chevron-down"></i></a></li>


                                    <li class="hassubs">
                                        <a href="#">Pages<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="{{route('product.showProductCategory',['id'=>$categories[0]->id])}}">Shop<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="{{route('cart.showCart')}}">Cart<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="{{route('contact.showContactPage')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('contact.showContactPage')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
                                </ul>
                            </div>

                            <!-- Menu Trigger -->

                            <div class="menu_trigger_container ml-auto">
                                <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                                    <div class="menu_burger">
                                        <div class="menu_trigger_text">menu</div>
                                        <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu -->

        <div class="page_menu">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="page_menu_content">

                            <div class="page_menu_search">
                                <form action="#">
                                    <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                                </form>
                            </div>
                            <ul class="page_menu_nav">
                                <li class="page_menu_item has-children">
                                    <a href="#">Language<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item has-children">
                                    <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item">
                                    <a href="#">Home<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item has-children">
                                    <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                                        <li class="page_menu_item has-children">
                                            <a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item has-children">
                                    <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item has-children">
                                    <a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
                            </ul>

                            <div class="menu_contact">
                                <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('frontend/images/phone_white.png')}}" alt=""></div> 0123 456 789 </div>
                                <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('frontend/images/mail_white.png')}}" alt=""></div><a href="{{$siteSetting[0]->phone_one}}">{{$siteSetting[0]->email}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @yield('content')
    @include('page.layout.core.newletter')
    @include('page.layout.core.footer')
    @include('page.layout.core.coppyright')


</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>
{{--<script src="{{ asset('frontend/styles/bootstrap4/popper.js')}}"></script>--}}
{{--<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>--}}
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js')}}"></script>
@yield('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif

</script>


<script>
    $(document).on("click", "#return", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to Return?",
            text: "Once Teturn, this will return your money!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Cancel!");
                }
            });
    });
    $( document ).ready(function() {
        $(document).on("click", ".cart_button_clear", function(e){
            e.preventDefault();
            swal({
                title: "Are you Want to delete cart?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "{{route('cart.destroyCart')}}"
                    }
                });
        });
    });

</script>

<script>
    $(function (){
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true,
                    slideBy: 2
                },
                600: {
                    items: 3,
                    nav: true,
                },
                1000: {
                    items: 4,
                    nav: true,
                }
            }
        });
    })
</script>
<script type="text/javascript">

    $(document).ready(function(){
        $('.addcart').on('click', function(){
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: " {{ url('/add-cart/') }}/"+id,
                    type:"GET",
                    datType:"json",
                    success:function(data){
                        $('#count').html(data.count);
                        $('#subtotal').html(data.subtotal);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            })
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            })
                        }


                    },
                });

            }else{
                alert('danger');
            }
        });

        $('.addWishlist').on('click', function(){
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: " {{ url('/customer/add-wishlist/') }}/"+id,
                    type:"GET",
                    datType:"json",
                    success:function(data){
                        console.log(data);
                        $('#wishlist').html(data.count);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            })
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            })
                        }


                    },
                });

            }else{
                alert('danger');
            }
        });

    });

</script>
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
<script>
    $(function (){
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true,
                    slideBy: 2
                },
                600: {
                    items: 3,
                    nav: true,
                },
                1000: {
                    items: 4,
                    nav: true,
                }
            }
        });
    })
</script>


</body>

</html>
