<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ishop">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>One click</title>

    <!-- vendor css -->
    <link href="{{asset('backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css ')}}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/starlight.css')}}">
    <!-- Toarst CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

</head>

<body>

<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> Ishop</a></div>
<div class="sl-sideleft">
    <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
    </div><!-- input-group -->

    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">
        <a href="{{route('dashboard.show')}}" class="sl-menu-link active">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @if(\Illuminate\Support\Facades\Auth::user()->category == 1)
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Category</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('category.list')}}" class="nav-link">Category List</a></li>
            <li class="nav-item"><a href="{{route('subcategory.list')}}" class="nav-link">Sub Category</a></li>
            <li class="nav-item"><a href="{{route('brand.list')}}" class="nav-link">Brand</a></li>
        </ul>
        @else
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->coupon == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Coupon</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('coupon.list')}}" class="nav-link">Coupon List</a></li>
        </ul>
        @else
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->product == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Products</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('product.createForm')}}" class="nav-link">Add Product</a></li>
            <li class="nav-item"><a href="{{route('product.list')}}" class="nav-link">All Product</a></li>
        </ul>
        @else
            @endif
        @if(\Illuminate\Support\Facades\Auth::user()->order == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('order.showOrder')}}" class="nav-link">New Order</a></li>
            <li class="nav-item"><a href="{{route('order.showAcceptPayment')}}" class="nav-link">Accept Payment </a></li>
            <li class="nav-item"><a href="{{route('order.showCancelOrder')}}" class="nav-link">Cancel Order </a></li>
            <li class="nav-item"><a href="{{route('order.showProcessPayment')}}" class="nav-link">Process Delivery </a></li>
            <li class="nav-item"><a href="{{route('order.showSuccessPayment')}}" class="nav-link">Delivery Success </a></li>
        </ul>
        @else
            @endif

        @if(\Illuminate\Support\Facades\Auth::user()->blog == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Blog</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('postcategory.list') }}" class="nav-link">Blog Category</a></li>

            <li class="nav-item"><a href="{{route('post.createForm')}}" class="nav-link">Add Post</a></li>
            <li class="nav-item"><a href="{{route('post.list')}}" class="nav-link">Post List</a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->other == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Others</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('newslater.list') }}" class="nav-link">Newslaters</a></li>
            <li class="nav-item"><a href="#" class="nav-link">SEO Setting </a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->report == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Reports</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('report.getTodayOrder')}}" class="nav-link">Today Order</a></li>
            <li class="nav-item"><a href="{{route('report.getTodayDelivery')}}" class="nav-link">Today Delivery </a></li>
            <li class="nav-item"><a href="{{route('report.getThisMonthDelivery')}}" class="nav-link">This Month </a></li>
            <li class="nav-item"><a href="{{route('report.searchReport')}}" class="nav-link">Search Report </a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->role == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">User Role</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('admin.createUser')}}" class="nav-link">Create User</a></li>
            <li class="nav-item"><a href="{{route('admin.showUser')}}" class="nav-link">All User </a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->return == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Return Order</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="" class="nav-link">Return Request</a></li>
            <li class="nav-item"><a href="" class="nav-link">All Request </a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->stock == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Product Stocks</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('product.getProductStock')}}" class="nav-link">Stock</a></li>
        </ul>
        @else
            @endif

        @if(\Illuminate\Support\Facades\Auth::user()->contact == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Contact Message</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('contact.getMessage')}}" class="nav-link">All Message </a></li>
        </ul>
        @else
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->comment == 1)


        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Product Comments </span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href=" " class="nav-link">New Comments</a></li>
            <li class="nav-item"><a href=" " class="nav-link">All Comments </a></li>
        </ul>
        @else
            @endif

        @if(\Illuminate\Support\Facades\Auth::user()->setting == 1)

        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Site Setting  </span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('siteSetting.list') }}" class="nav-link">Site Setting</a></li>
        </ul>
        @else
        @endif
    </div><!-- sl-sideleft-menu -->

    <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="sl-header">
    <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name">Hi {{\Illuminate\Support\Facades\Auth::user()->username}}</span></span>
{{--                    <img src="{{asset('backend/img/img3.jpg')}}" class="wd-32 rounded-circle" alt="">--}}
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                        <li><a href="{{route('admin.changepassword')}}"><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
{{--                        <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>--}}
{{--                        <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>--}}
{{--                        <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li>--}}
                        <li><a href="{{route('admin.logout')}}"><i class="icon ion-power"></i> Sign Out</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">
                <i class="icon ion-ios-bell-outline"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger"></span>
                <!-- end: if statement -->
            </a>
        </div><!-- navicon-right -->
    </div><!-- sl-header-right -->
</div><!-- sl-header -->
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: RIGHT PANEL ########## -->
<div class="sl-sideright">
    <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
        </li>
    </ul><!-- sidebar-tabs -->

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
            <div class="media-list">
                <!-- loop starts here -->
                <a href="" class="media-list-link">
                    <div class="media">
                        <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                            <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                        </div>
                    </div><!-- media -->
                </a>
                <!-- loop ends here -->
                <a href="" class="media-list-link">
                    <div class="media">
                        <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Samantha Francis</p>
                            <span class="d-block tx-11 tx-gray-500">3 hours ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link">
                    <div class="media">
                        <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Robert Walker</p>
                            <span class="d-block tx-11 tx-gray-500">5 hours ago</span>
                            <p class="tx-13 mg-t-10 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link">
                    <div class="media">
                        <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Larry Smith</p>
                            <span class="d-block tx-11 tx-gray-500">Yesterday, 8:34pm</span>

                            <p class="tx-13 mg-t-10 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link">
                    <div class="media">
                        <div class="media-body">
                            <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                            <span class="d-block tx-11 tx-gray-500">Jan 23, 2:32am</span>
                            <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                        </div>
                    </div><!-- media -->
                </a>
            </div><!-- media-list -->
            <div class="pd-15">
                <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
            </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
            <div class="media-list">
                <!-- loop starts here -->
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                            <span class="tx-12">October 03, 2017 8:45am</span>
                        </div>
                    </div><!-- media -->
                </a>
                <!-- loop ends here -->
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                            <span class="tx-12">October 02, 2017 12:44am</span>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <img src="{{asset('backend/img/img10.jp')}}g" class="wd-40 rounded-circle" alt="">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                            <span class="tx-12">October 01, 2017 10:20pm</span`>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                            <span class="tx-12">October 01, 2017 6:08pm</span>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 12 others in a post.</p>
                            <span class="tx-12">September 27, 2017 6:45am</span>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700">10+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                            <span class="tx-12">September 28, 2017 11:30pm</span>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Great Pyramid</strong></p>
                            <span class="tx-12">September 26, 2017 11:01am</span>
                        </div>
                    </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                    <div class="media pd-x-20 pd-y-15">
                        <div class="media-body">
                            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                            <span class="tx-12">September 23, 2017 9:19pm</span>
                        </div>
                    </div><!-- media -->
                </a>
            </div><!-- media-list -->
        </div><!-- #notifications -->

    </div><!-- tab-content -->
</div><!-- sl-sideright -->
<!-- ########## END: RIGHT PANEL ########## --->

@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="{{asset('backend/lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('backend/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/lib/d3/d3.js')}}"></script>
<script src="{{asset('backend/lib/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{asset('backend/lib/chart.js/Chart.js')}}"></script>
<script src="{{asset('backend/lib/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('backend/lib/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('backend/lib/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>

<script src="{{asset('backend/lib/highlightjs/highlight.pack.js')}}"></script>
<script src="{{asset('backend/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>
{{--datatable--}}
<script>
    $(function(){
        'use strict';

        $('#datatable1').DataTable({
            responsive: true,

            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

        $('#datatable2').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
</script>

<script src="{{asset('backend/js/starlight.js')}}"></script>
<script src="{{asset('backend/js/ResizeSensor.js')}}"></script>
<script src="{{asset('backend/js/dashboard.js')}}"></script>
<script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
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
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });
</script>
<script>
    @yield('js')

</script>

</body>
</html>
