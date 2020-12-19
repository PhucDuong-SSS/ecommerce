@extends('admin.layout.admin_layouts')
@section('content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Product List</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Product List
                    <a href="{{route('product.createForm')}}" class="btn btn-sm btn-warning" style="float: right;">Add New</a>
                </h6>


                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
{{--                            <th class="wd-5p">Product Code</th>--}}
                            <th class="wd-20p">Product Name</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-5p">Category</th>
                            <th class="wd-5p">Brand</th>
                            <th class="wd-15p">Quantity</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-25p">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $row)
                            <tr>
{{--                                <td>{{ $row->code }}</td>--}}
                                <td>{{ $row->name }}</td>

                                <td> <img src="{{ asset($row->image_one) }}" height="50px;" width="50px;"> </td>
                                <td>{{ $row->category->name }}</td>
                                <td>{{ $row->brand->name??'' }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>
                                    @if($row->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif

                                </td>



                                <td>
                                    <a href="{{ route('product.editForm', $row->id) }} " class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('product.delete',$row->id) }}" class="btn btn-sm btn-danger" title="delete" id="delete"><i class="fa fa-trash"></i></a>

                                    <a href="{{ route('product.show', $row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>


                                    @if($row->status == 1)
                                        <a href="{{route('product.inactive', $row->id)}}" class="btn btn-sm btn-danger" title="Inactive" ><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{route('product.active', $row->id)}}" class="btn btn-sm btn-info" title="Active" ><i class="fa fa-thumbs-up"></i></a>
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
