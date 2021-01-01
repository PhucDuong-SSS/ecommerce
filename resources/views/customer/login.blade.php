<!DOCTYPE html>
<html lang="en">
<head>
    <title>OneClick</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Ishop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/styles/login.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">




</head>

<body>



    <div class="main">

        <section class="signup">
            <!-- <img src="img/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{route('customer.login')}}" class="signup-form">
                        @csrf
                        <h2 class="form-title">Login account</h2>


                        <div class="form-group">
                            <input type="text" class="form-input" name="username"  placeholder="User Name"/>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="form-group">
                            <input type="password" class="form-input @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                                @enderror
                        </div>


                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Log in"/>
                        </div>
                        <!-- alert to user -->
                        <div style="text-align: center; color:red">

                        </div>

                    </form>
                    <p class="loginhere">
                        I do'nt have an account ? <a href="{{route('customer.register')}}" class="loginhere-link">Register here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>




<script src="{{ asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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

