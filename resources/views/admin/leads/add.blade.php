@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Add Inquiry</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Inquiries</li>
                        <li class="breadcrumb-item active">Add Inquiry</li>
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
                            <form action="{{route('inquary.store')}}" method="post" type="multipart/form-date">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Vendor Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="vendor_name" placeholder="Vendor name" value="{{old('vendor_name')}}">
                                            @error('vendor_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Vendor ID <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="vendor_id" placeholder="Vendor ID" value="{{old('vendor_id')}}">
                                            @error('vendor_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_name" placeholder="Product name" value="{{old('product_name')}}">
                                            @error('product_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product ID <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="product_id" placeholder="Product ID" value="{{old('product_id')}}">
                                            @error('product_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea rows="4" class="form-control" name="description" placeholder="Description">{{old('description')}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Quantity <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="quantity" placeholder="Quantity" value="{{old('quantity')}}">
                                            @error('quantity')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline checkbox checkbox-dark mb-3">
                                            <input class="form-check-input" id="assistance" type="checkbox" name="assistance">
                                            <label class="form-check-label" for="assistance">Need Globlix Assistance ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline checkbox checkbox-dark mb-3">
                                            <input class="form-check-input" id="attachment" type="checkbox" name="attachment">
                                            <label class="form-check-label" for="attachment">Any Attachment ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Price at Vendor <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="price_at_vendor" placeholder="Price at Vendor" value="{{old('price_at_vendor')}}">
                                            @error('price_at_vendor')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline checkbox checkbox-dark mb-3">
                                            <input class="form-check-input" id="video_call" type="checkbox" name="video_call">
                                            <label class="form-check-label" for="video_call">Video Call ?</label>
                                        </div>
                                    </div>
                                </div>
                                
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