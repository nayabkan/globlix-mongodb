@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Auction</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Auctions</li>
                        <li class="breadcrumb-item active">Edit Auction</li>
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
                            <form action="{{route('updateauction',$auction->_id)}}" method="post">
                                @csrf
                                <div class="row" id="auctions_prod">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Auction Product</label>
                                            <select name="product_id" class="form-control">
                                                <option>Select Auction Product</option>
                                                @foreach($products as $key=>$prodss)
                                                    <option value="{{$prodss->_id}}" {{(($prodss->_id==$auction->product_id) ? 'selected' : '')}}>{{$prodss->title}}</option>
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
                                            <label>Vendor Name</label>
                                            <select name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $key=>$vendor)
                                                    <option value="{{$vendor->_id}}" {{(($vendor->_id==$auction->vendor_id) ? 'selected' : '')}}>{{$vendor->firstname}}</option>
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
                                            <input class="form-control digits" name="start_date" id="example-datetime-local-input" type="datetime-local" placeholder="2022-01-19T18:45:00" value="{{$auction->start_date}}">
                                            <!-- <input class="form-control" type="date" step="0.01" name="start_date" placeholder="Start Date" value="{{$auction->start_date}}"> -->
                                            @error('start_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Expire Date <span class="text-danger">*</span></label>
                                            <input class="form-control digits" name="expire_date" id="example-datetime-local-input" type="datetime-local" placeholder="2022-01-19T18:45:00" value="{{$auction->expire_date}}">
                                            <!-- <input class="form-control" type="date" step="0.01" name="expire_date" placeholder="Expire Date" value="{{$auction->expire_date}}"> -->
                                            @error('expire_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Auction Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{(($auction->status=='active')? 'selected' : '')}}>Active</option>
                                            <option value="deactivate" {{(($auction->status=='deactivate')? 'selected' : '')}}>Deactivate</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <input type="hidden" name="status" value="{{$auction->status}}"> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end row">
                                            <input type="submit" class="btn btn-success me-3 col-md-2" value="Update">
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

@endsection