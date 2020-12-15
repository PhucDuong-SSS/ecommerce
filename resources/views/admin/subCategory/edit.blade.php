@extends('admin.layout.admin_layouts')
@section('content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Sub Category Update</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Sub Category Update </h6>

                <div class="table-wrapper">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('subcategory.update',$subCategory->id)}}">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Category Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $subCategory->name }}" name="subcategory_name">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Category Name</label>

                                <select class="form-control" name="category_id">

                                    @foreach($categoryList as $row)
                                        <option value="{{ $row->id }}"
                                        <?php if ($row->id == $subCategory->category->id ) {
                                            echo "selected"; } ?> >{{ $row->name }}  </option>
                                    @endforeach

                                </select>


                            </div>

                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Update</button>

                        </div>
                    </form>


                </div><!-- table-wrapper -->
            </div><!-- card -->




        </div><!-- sl-mainpanel -->

@endsection