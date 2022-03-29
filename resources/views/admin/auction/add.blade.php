@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Create Auction</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Auctions</li>
                        <li class="breadcrumb-item active">Create Auction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form theme-form">
                            <form action="{{route('storeauction')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row" id="auctionProduct">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Auction Product</label>
                                            <select name="product_id" class="form-control">
                                                <option value="">Select Product</option>
                                                @foreach($products as $key=>$prods)
                                                    <option value="{{$prods->_id}}">{{$prods->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Vendor Name <span class="text-danger">*</span></label>
                                            <select name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $key=>$vendor)
                                                    <option value="{{$vendor->_id}}">{{$vendor->firstname}}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Expire Date <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" step="0.01" name="expire_date" placeholder="Expire Date" value="{{old('expire_date')}}">
                                            @error('expire_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="active">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end row">
                                            <input type="submit" class="btn btn-success me-3 col-md-2" value="Add">
                                            <input type="reset" class="btn btn-danger col-md-2" value="Cancel">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- footer start-->

@endsection
@push('scripts')
<script>
    // $('#is_parent').change(function(){
    //     var is_checked=$('#is_parent').prop('checked');
    //     if(is_checked){
    //         $('#parent_cat_div').addClass('d-none');
    //         $('#parent_cat_div').val('');
    //     }
    //     else{
    //         $('#parent_cat_div').removeClass('d-none');
    //     }
    // })
</script>
@endpush