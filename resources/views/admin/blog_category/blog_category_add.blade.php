@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
        <div class="card-body">

            <h1 class="card-title">Add Blog Category Page</h1>
           <hr>
           <form action="{{route('store.blog.category')}}" id="myForm" method="post" enctype="multipart/form-data">
            @csrf


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                <div class="form-group col-sm-10">
                    <input name="blog_category" class="form-control" type="text"  id="example-text-input">
                    {{-- @error('blog_category')
                        <span class="text-danger">{{$message}}</span>
                    @enderror --}}
                </div>
            </div>


                </div>
            </div>


            <hr>
            <input type="submit" class="btn btn-outline-success waves-effect waves-light" value="Add Blog Category">
        </form>
        </div>
    </div>
</div>
</div>

</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $('#myForm').validate({
        rules:{
            blog_category:{
                required:true,
            },
        },
        messages:{
            blog_category:{
                required:'Please Enter Blog Category',
            },
        },
        errorElement:'span',
        errorPlacement:function(error,element){
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight:function(element,errorClass,validClass){
            $(element).addClass('is-invalid');
        },
        unhighlight:function(element,errorClass,validClass){
            $(element).removeClass('is-invalid');
        },
    });
});

</script>


@endsection