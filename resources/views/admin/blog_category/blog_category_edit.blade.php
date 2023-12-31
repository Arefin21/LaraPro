@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
        <div class="card-body">

            <h1 class="card-title">Edit Blog Category Page</h1>
           <hr>
           <form action="{{route('update.blog.category')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$blogcategory->id}}">

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                <div class="col-sm-10">
                    <input name="blog_category" class="form-control" type="text" value="{{$blogcategory->blog_category}}"  id="example-text-input">
                    @error('blog_category')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>


                </div>
            </div>


            <hr>
            <input type="submit" class="btn btn-outline-success waves-effect waves-light" value="Update Blog Category">
        </form>
        </div>
    </div>
</div>
</div>

</div>
</div>


@endsection