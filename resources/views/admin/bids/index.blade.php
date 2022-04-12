@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Bidding list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Biddings</li>
                        <li class="breadcrumb-item active">Bidding list</li>
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
                        @if(count($bids)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>User</th>
                                        <th>Bid Price</th>
                                        <th>Vendor</th>
                                        <th>Bid Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($bids as $aucprod)
                                    @php $product_id = $aucprod->product_id; 
                                        $vendor_id = $aucprod->vendor_id;
                                    @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <h6> {{ \App\Models\Product::where(['_id' => $product_id])->pluck('title')->first() }} </h6>
                                        </td>
                                        <td>{{ \App\Models\User::where(['_id' => $aucprod->user_id])->pluck('firstname')->first() }}</td>
                                        <td>{{ $aucprod->bid_price }}</td>
                                        <td>{{ \App\Models\Vendor::where(['_id' => $vendor_id])->pluck('firstname')->first() }}</td>
                                        <td>{{ $aucprod->created_at }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success" title="View Bid">View</a>
                                            
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Bid found!!! Please wait till Bid Placed</h6>
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