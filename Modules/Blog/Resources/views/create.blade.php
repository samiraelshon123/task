@extends('layouts.app')
@section('content')
    <!-- Start Blog Area -->

                <div class="col-lg-9 col-12">
                   <h3>Create Post</h3>

                   <form action="{{url('dashboard/store_post')}}" method="post" enctype="multipart/form-data">
                    @csrf
        <div class="form-group">

            <label for="">Title</label>
            <input type="text" name="title" class="form-control">
            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
        </div>


            <div class="form-group">
                <label for="">Description</label>
                <textarea name="descreption" id="" cols="30" rows="10" class="form-control"></textarea>
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
            </div>


        <div class="row">


            <div class="col-4">
                <label for="">status</label>
                <select name="status" id="" class="form-control">
                    <option value="1">active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-12">
                <div class="file">
                   <input type="file" class="form-control" name="image">
                </div>
            </div>
        </div>


        <div class="form-group pt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>


    <!-- End Blog Area -->
@endsection
@section('script')
    <script src="{{asset('frontend/js/summernote/summernote-bs4.min.js')}}"></script>
@endsection
