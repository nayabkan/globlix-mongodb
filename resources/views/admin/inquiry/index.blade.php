@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Inquiries list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Inquiries</li>
                        <li class="breadcrumb-item active">Inquiries list</li>
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
                        <div class="table-responsive product-table">
                        @if(count($inquaries)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Qty Type</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>User</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($inquaries as $inquary)
                                    @php $prodid = $inquary->product_id; $userid = $inquary->user_id;  @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ \App\Models\Product::where(['_id' => $prodid])->pluck('title')->first() }}</td>
                                        <td>{{$inquary->quantity}}</td>
                                        <td>{{$inquary->quantity_type}}</td>
                                        <td>{{$inquary->email }}</td>
                                        <td>{{$inquary->message }}</td>
                                        <td>{{ \App\Models\User::where(['_id' => $userid])->pluck('firstname')->first() }}</td>
                                        <td>
                                            <a href="{{route('inquary.destroy',$inquary->id)}}" class="btn btn-danger" title="Delete Inquary">Delete</a>
                                            <a href="" class="btn btn-success" title="Send Email">Send</a>
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Inquaries found!!! Please place any inquary</h6>
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