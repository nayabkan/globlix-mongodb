@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Vendors list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Vendors</li>
                        <li class="breadcrumb-item active">Vendor list</li>
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
                        <!-- <div class="float-right">
                            <a href="{{route('category.create')}}" class="btn btn-info">Add Category</a>
                        </div> -->
                        <div class="table-responsive product-table">
                        @if(count($vendors)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $slno=1; @endphp
                                    @foreach($vendors as $user)
                                    <tr>
                                    <td>{{$slno}}</td>
                                        <td>
                                            <h6> {{$user->firstname.' '.$user->lastname}} </h6>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->country }}</td>
                                        @if($user->status=='active')
                                            <td class="font-success">{{$user->status}}</td>
                                        @elseif($user->status=='pending')
                                            <td class="font-info">{{$user->status}}</td>
                                        @else
                                            <td class="font-warning">{{$user->status}}</td>
                                        @endif
                                        <td>
                                            <a href="#" class="btn btn-success" title="Edit Vendor">Edit</a>
                                            <a href="#" class="btn btn-danger" title="Delete Vendor">Delete</a>
                                        </td>
                                    </tr>
                                    @php $slno++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Vendors found!!! Please create vendor.</h6>
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