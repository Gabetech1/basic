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
                <div class="card-header">All Brand</div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Brand Image</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @php($i = 1)
                    @foreach($brands as $brand)
                    <tr>
                        <th scope="row"> {{ $brands->firstItem()+$loop->index }}</th>
                        <td>{{ $brand->brand_name }}</td>
                        <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 70px;" alt=""></td>
                        @if( $brand->created_at == NULL)
                        <td><span class="text-danger">No date set</span></td>
                        @else
                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                        @endif

                        <td>
                            <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                         </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
              {{ $brands->links() }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add brand</div>
                <div class="card-body">
                    <form action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control">
                            @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_image">Brand Image</label>
                            <input type="file" name="brand_image" id="brand_image" class="form-control">
                            @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Add brand</button>
                    </form>

                </div>

            </div>
        </div>
           </div>
       </div>

    </div>

@endsection
