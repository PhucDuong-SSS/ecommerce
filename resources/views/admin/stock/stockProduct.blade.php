@extends('admin.layout.admin_layouts')

@section('content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Stock Product List</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Stock Product List

                </h6>


                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Product Code</th>
                            <th class="wd-15p">Product Name</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-15p">Category</th>
                            <th class="wd-15p">Brand</th>
                            <th class="wd-15p">Quantity</th>
                            <th class="wd-15p">Status</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $row)
                            <tr>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->name }}</td>

                                <td> <img src="{{ asset($row->image_one) }}" height="50px;" width="50px;"> </td>
                                <td>{{ $row->category->name}}</td>
                                <td>{{ $row->brand->name }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>
                                    @if($row->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->





@endsection
