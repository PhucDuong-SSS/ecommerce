@extends('admin.layout.admin_layouts')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('dashboard.show')}}">Ishop</a>
            <span class="breadcrumb-item active">Setting</span>
        </nav>

        <div class="sl-pagebody">


            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Site Setting   </h6>

                <form method="post" action="{{route('setting.update',$setting->id)}}" >
                    @csrf

                    <input type="hidden" name="id" value="{{ $setting->id }}">

                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label"> Shiipng charge: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="shipping_charge" required="" value="{{ $setting->shipping_charge }}">
                                    @error('shipping_charge')
                                    <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Shop name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="shopname"  value="{{ $setting->shopname }}">
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="email" name="email"  required value="{{ $setting->email }}">
                                    @error('email')
                                    <div style="color: red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->




                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone"  value="{{ $setting->phone }}">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="address"  value="{{ $setting->adderss }}">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">logo name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="logo"  value="{{ $setting->logo }}">
                                </div>
                            </div><!-- col-4 -->

                        </div><!-- row -->

                        <hr>

                    </div><!-- end row -->
                    <br><br>


                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Update  </button>

                    </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div><!-- card -->

        </form>




    </div><!-- row -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
