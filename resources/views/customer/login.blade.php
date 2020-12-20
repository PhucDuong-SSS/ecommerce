    <!DOCTYPE html>
<html lang="en">
<head>
    <title>OneClick</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/plugins/slick-1.8.0/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">



<!-- chart -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">




</head>

<body>

    <div class="contact_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6  " style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Sign In</div>

                        <form action="{{route('customer.login')}}" id="contact_form" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}"  aria-describedby="emailHelp"  required="">
                                @error('usrname')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"  aria-describedby="emailHelp" name="password" required="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror

                            </div>


                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                        <br>
                        <a href="">Already Registered? Login</a>   <br> <br>
                        <a href="">I forgot my password</a>   <br> <br>

                        <button type="submit" class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Login with Facebook </button>

                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Login with Google </a>

                    </div>
                </div>


{{--                <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">--}}
{{--                    <div class="contact_form_container">--}}
{{--                        <div class="contact_form_title text-center">Sign Up</div>--}}

{{--                        <form action="" id="contact_form" method="post">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Full Name</label>--}}
{{--                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Full Name " name="name" required="">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Phone</label>--}}
{{--                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  aria-describedby="emailHelp" placeholder="Enter Your Phone " required="">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Email</label>--}}
{{--                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="Enter Your Email " required="">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Password</label>--}}
{{--                                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Password " name="password" required="">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Confirm Password</label>--}}
{{--                                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Re-Type Password " name="password_confirmation" required="">--}}
{{--                            </div>--}}
{{--                            <div class="contact_form_button">--}}
{{--                                <button type="submit" class="btn btn-info">Sign Up</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>







</div>





<script src="{{ asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js')}}"></script>
@yield('script')
{{--<script src="{{ asset('frontend/js/custom.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>



{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
{{--<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>--}}
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











</body>

</html>

