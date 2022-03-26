@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Brands list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Brands</li>
                        <li class="breadcrumb-item active">Brands list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <a href="{{route('brands.create')}}" class="btn btn-info">Add Brand</a>
                        </div>
                        <div class="table-responsive product-table">
                        @if(count($brands)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <img src="{{$brand->image ? $brand->image : ''}}" alt="" style="max-width: 64px;">
                                        </td>
                                        <td>
                                            <h6> {{$brand->title}} </h6>
                                        </td>
                                        <td>Admin</td>
                                        @if($brand->status=='active')
                                            <td class="font-success">{{$brand->status}}</td>
                                        @else
                                            <td class="font-warning">{{$brand->status}}</td>
                                        @endif
                                        <td>
                                            <a href="{{route('brands.edit',$brand->_id)}}" class="btn btn-success" title="Edit Brand">Edit</a>
                                            <form method="POST" class="d-inline-block" action="{{route('brands.destroy',[$brand->_id])}}">
                                              @csrf 
                                              @method('delete')
                                                  <button class="btn btn-danger btn-sm dltBtn" data-id="{{$brand->_id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Brand found!!! Please create Brand</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
        

@endsection