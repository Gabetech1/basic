@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
       <div class="container">
           <div class="row">

            <h4>Home Slider</h4>
            <a href="{{ route('add.slider') }}" class="btn btn-info">Add Slider</a>
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
                    <th scope="col" width="5%">Serial No.</th>
                    <th scope="col" width="15%">Slider Title</th>
                    <th scope="col" width="30%">Descriptions</th>
                    <th scope="col" width="20%">Image</th>
                    <th scope="col" width="10$">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @php($i = 1)
                    @foreach($sliders as $slider)
                    <tr>
                        <th scope="row"> {{ $i++ }}</th>
                        <td>{{ $slider->title }}</td>
                        <td>{{ $slider->description }}</td>
                        <td><img src="{{ asset($slider->image) }}" style="height: 40px; width: 70px;" alt=""></td>

                        <td>
                            <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                         </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
              {{-- {{ $sliders->links() }} --}}
            </div>
        </div>


    </div>

</div>

@endsection
