@extends('page.layout.app_layout')
@section('content')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">

@endsection
@section('script')
    <script src="{{ asset('frontend/js/cart_custom.js')}}"></script>
@endsection
    <div class="contact_form">
        <div class="container">
            <div class="row mg-t--100">
                <div class="col col-lg-8  col-sm-12 ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Payment Type </th>
                                <th scope="col">Payment ID </th>
                                <th scope="col">Amount </th>
                                <th scope="col">Date </th>
                                <th scope="col">Status  </th>
                                <th scope="col">Status Code </th>
                                <th scope="col">Action </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $row)
                                <tr>
                                    <td scope="col">{{ $row->payment_type }} </td>
                                    <td scope="col">{{ $row->payment_id }} </td>
                                    <td scope="col">{{ $row->total }}$  </td>
                                    <td scope="col">{{ $row->date }}  </td>

                                    <td scope="col">
                                        @if($row->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($row->status == 1)
                                            <span class="badge badge-info">Payment Accept</span>
                                        @elseif($row->status == 2)
                                            <span class="badge badge-warning">Progress</span>
                                        @elseif($row->status == 3)
                                            <span class="badge badge-success">Delevered</span>
                                        @else
                                            <span class="badge badge-danger">Cancle</span>

                                        @endif

                                    </td>

                                    <td scope="col">{{ $row->status_code }}  </td>
                                    <td scope="col">
                                        <a href="" class="btn btn-sm btn-info"> View</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="col-lg-4 col-sm-12 ">
                    <div class="card">
                        <img src="{{ asset('public/frontend/images/kaziariyan.png') }}" class="card-img-top" style="height: 90px; width: 90px; margin: auto;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ Auth::guard('customer')->user()->name }}</h5>

                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="{{route('customer.showFormChangePassword')}}">Change Password</a>  </li>
                            <li class="list-group-item">Edit Profile</li>
                            <li class="list-group-item"><a href=""> Return Order</a> </li>
                        </ul>

                        <div class="card-body">
                            <a href="{{ route('customer.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

@endsection
