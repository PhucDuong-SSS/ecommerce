@extends('admin.layout.admin_layouts')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Message Section</span>
        </nav>

        <div class="sl-pagebody">


            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Message Details Page </h6>

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label"> Name: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $message->name }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $message->phone }}</strong>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label><br>
                                <strong>{{ $message->email }}</strong>

                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Message: <span class="tx-danger">*</span></label>
                                <br>
                                <p>   {!! $message->message !!} </p>

                            </div>
                        </div><!-- col-4 -->

                    </div><!-- row -->


                </div><!-- form-layout -->
            </div><!-- card -->


        </div><!-- row -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection

