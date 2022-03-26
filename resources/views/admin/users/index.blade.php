@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Users list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Users list</li>
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
                            <a href="#" class="btn btn-info">Add User</a>
                        </div>
                        <div class="table-responsive product-table">
                        @if(count($allusers)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $slno=1; @endphp
                                    @foreach($allusers as $user)
                                    <tr>
                                        <td>{{$slno}}</td>
                                        <td>
                                            <h6> {{$user->name}} </h6>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->gender }}</td>
                                        @if($user->status=='active')
                                            <td class="font-success">{{$user->status}}</td>
                                        @else
                                            <td class="font-warning">{{$user->status}}</td>
                                        @endif
                                        <td>
                                            <a href="#" class="btn btn-success" title="Edit User">Edit</a>
                                            <a href="#" class="btn btn-danger" title="Delete User">Delete</a>
                                        </td>
                                    </tr>
                                    @php $slno++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Users found!!! Please create User</h6>
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