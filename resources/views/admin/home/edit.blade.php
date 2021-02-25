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
                <div class="card-header">Edit HomeAbout</div>
                <div class="card-body">
                    <form action="{{ url('about/update/'.$homeabout->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" name="about_title" value="{{ $homeabout->title }}" id="exampleFormControlInput1" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Sub Title</label>
                            <textarea class="form-control" name="about_sub_title" id="exampleFormControlTextarea1" rows="3">{{ $homeabout->sub_title }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content</label>
                            <textarea class="form-control" name="about_content" id="exampleFormControlTextarea1" rows="5">{{ $homeabout->content }}</textarea>
                        </div>

                        <button class="btn btn-primary">Update HomeAbout</button>
                    </form>

                </div>

            </div>
        </div>
           </div>
       </div>
    </div>

@endsection
