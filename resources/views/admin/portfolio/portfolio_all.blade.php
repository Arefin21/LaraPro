@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Portfolio All</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio All</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Portfolio Name</th>
                    <th>Portfolio Title</th>
                    <th>Portfolio Image</th>
                    <th>Portfolio Description</th>
                    <th>Action</th>
                </tr>
                </thead>


                <tbody>

                    @php($i=1)

                    @foreach ($portfolio as $item )

                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset($item->portfolio_image)}}" style="width: 60px; hight:500px" alt=""></td>
                        <td>{{$item->portfolio_name}}</td>
                        <td>{{$item->portfolio_titme}}</td>
                        <td>{{$item->portfolio_description}}</td>
                        <td>

                            <a href="{{route('edit.multi.image',$item->id)}}" class="btn btn-outline-info sm" title="Edit Image"> <i class="fas fa-edit"></i> </a>
                            <a href="{{route('delete.multi.image',$item->id)}}" class="btn btn-outline-danger" title="Delete Image" id="delete"> <i class="fas fa-trash"></i> </a>

                        </td>
                    </tr>
                        
                    @endforeach
                
                </tbody>
            </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        
    </div>
</div>

@endsection
