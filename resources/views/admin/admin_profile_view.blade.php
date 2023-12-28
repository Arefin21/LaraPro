@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

<div class="row">
    <div class="col-lg-4">
        <div class="card"><br><br>
            <center>
            {{-- <img class="rounded-circle avatar-xl" src="{{asset('backend/assets/images/small/img-5.jpg')}}" alt="Card image cap"> --}}
            <img class="rounded-circle avatar-xl" src="{{asset('backend/assets/images/akram.jpg')}}" alt="Card image cap">
           
            <div class="card-body">
                <h4 class="card-title">Name: {{$adminData->name}}</h4>
                <hr>
                <h4 class="card-title">Email: {{$adminData->email}}</h4>
                <hr>
                <h4 class="card-title">Username: {{$adminData->username}}</h4>
                <hr>
                <a class="btn btn-primary" href="{{route('edit.profile')}}">Edit Profile</a>
            </div>
        </center>
        </div>
    </div>

</div>

</div>
</div>

@endsection