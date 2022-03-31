@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Auction list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Auctions</li>
                        <li class="breadcrumb-item active">Auction list</li>
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
                    <div class="card-header p-0" style="margin-left:85%;padding-top:10px;">
                        <a href="{{route('addauction')}}" class="btn btn-info btn-sm float-right ml-2 mt-2" title="Add Auction">Add Auction</a>
                    </div>
                    <div class="card-body" style="padding-top:10px;">
                        <div class="table-responsive product-table">
                        @if(count($auctions)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Vendor</th>
                                        <th>Start Date</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($auctions as $aucprod)
                                    @php $product_id = $aucprod->product_id; 
                                        $vendor_id = $aucprod->vendor_id;
                                    @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <h6> {{ \App\Models\Product::where(['_id' => $product_id])->pluck('title')->first() }} </h6>
                                        </td>
                                        <td>{{ \App\Models\Vendor::where(['_id' => $vendor_id])->pluck('firstname')->first() }}</td>
                                        <td>{{ $aucprod->start_date }}</td>
                                        <td>{{ $aucprod->expire_date }}</td>
                                        @if($aucprod->status=='active')
                                            <td class="font-success">{{$aucprod->status}}</td>
                                        @else
                                            <td class="font-warning">{{$aucprod->status}}</td>
                                        @endif
                                        <td>
                                            <a href="{{route('editauction',$aucprod->_id)}}" class="btn btn-success" title="Edit Auction">Edit</a>
                                            <form method="POST" class="d-inline-block" action="{{route('deleteauction',[$aucprod->_id])}}">
                                              @csrf 
                                              @method('delete')
                                                  <button class="btn btn-danger btn-sm dltBtn" data-id="{{$aucprod->_id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Auction found!!! Please create Auction</h6>
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