@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
        <div class="card-body">

            <h1 class="card-title">Portfolio Page</h1>
           <hr>
           <form action="{{route('store.portfolio')}}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Name</label>
                <div class="col-sm-10">
                    <input name="portfolio_name" class="form-control" type="text"  id="example-text-input">
                    @error('portfolio_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Title</label>
                <div class="col-sm-10">
                    <input name="portfolio_title" class="form-control" type="text"  id="example-text-input">
                    @error('portfolio_title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Protfolio Description </label>
                <div class="col-sm-10">
      <textarea id="elm1" name="portfolio_description">
   
      </textarea>
                </div>
            </div>


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Image</label>
                <div class="col-sm-10">
                    <input name="portfolio_image" class="form-control" type="file"   id="image">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <img id="showImage" class="rounded-circle avatar-xl" 
        src="{{ url('upload/no_image.jpg') }}"
                     alt="Card image cap">
                </div>
            </div>
            <hr>
            <input type="submit" class="btn btn-outline-success waves-effect waves-light" value="Add Portfolio Data">
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