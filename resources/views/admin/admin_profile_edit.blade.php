@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
        <div class="card-body">

            <h1 class="card-title">Update User Profile</h1>
           <hr>
           <form action="{{route('store.profile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="name" placeholder="Name" name="name" value="{{$editData->name}}">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" placeholder="Email" id="email" name="email"value="{{$editData->email}}">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="example-email-input" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="username" placeholder="Username" name="username"value="{{$editData->username}}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="example-email-input" class="col-sm-2 col-form-label">Profile Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="image" name="profile_image">
                </div>
            </div>

            <div class="row mb-3">
               
                <div class="col-sm-10">
                    <img id="showImage" class="rounded-circle avatar-xl" src="{{asset('backend/assets/images/akram.jpg')}}" alt="Card image cap">
                </div>
            </div>
            <hr>
            <input type="submit" class="btn btn-outline-success waves-effect waves-light" value="Update Profile">
            {{-- //<a class="btn btn-outline-success waves-effect waves-light" href="">Update Profile</a> --}}
        </form>
        </div>
    </div>
</div>
</div>

</div>
</div>

<script type="text/javascript">

$(document).ready(function(){

$("#image").change(function(e){

    var reader=new FileReader();
    reader.onload=function(e){
        $("#showImage").attr('src',e.target.result);
    };
        reader.readAsDataURL(e.target.files['0']);

});

});

</script>

@endsection