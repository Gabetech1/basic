@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
       <div class="container">
           <div class="row">

            <h4>Home About</h4>
            <a href="{{ route('add.about') }}" class="btn btn-info">Add Slider</a>
            <br><br>

        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <div class="card">
                <div class="card-header">All Slider</div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col" width="10%">SL No.</th>
                    <th scope="col" width="15%">Title</th>
                    <th scope="col" width="30%">Sub Title</th>
                    <th scope="col" width="20%">Content</th>
                    <th scope="col" width="10$">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @php($i = 1)
                    @foreach($homeabout as $about)
                    <tr>
                        <th scope="row"> {{ $i++ }}</th>
                        <td>{{ $about->title }}</td>
                        <td>{{ $about->sub_title }}</td>
                        <td>{{ $about->content }}</td>
                        <td>
                            <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                         </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
              {{-- {{ $homeabout->links() }} --}}
            </div>
        </div>


    </div>

</div>

@endsection
