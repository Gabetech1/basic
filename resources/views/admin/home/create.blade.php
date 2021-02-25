@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create HomeAbout</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.about') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" class="form-control" name="about_title" id="exampleFormControlInput1" placeholder="Enter Email">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Sub Title</label>
                    <textarea class="form-control" name="about_sub_title" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Content</label>
                    <textarea class="form-control" name="about_content" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
