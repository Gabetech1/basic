@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
       <div class="container">
           <div class="row">

        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card">
                <div class="card-header">Update Brand</div>
                <div class="card-body">
                    <form action="{{ url('brand/update/'.$brand->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                        <div class="form-group">
                            <label for="brand_name">Update Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ $brand->brand_name }}">
                            @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_image">Update Brand Name</label>
                            <input type="file" name="brand_image" id="brand_image" class="form-control" value="{{ $brand->brand_image }}">
                            @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img src="{{ asset($brand->brand_image) }}" width="400px" height="200px" alt="">
                        </div>

                        <button class="btn btn-primary">Update Brand</button>
                    </form>

                </div>

            </div>
        </div>
           </div>
       </div>
    </div>

@endsection
