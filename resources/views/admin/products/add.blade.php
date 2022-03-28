@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Create Product</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Create Product</li>
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
                            <form action="{{route('storeproduct')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="user_id" type="hidden" value="{{ Auth::guard('admin')->user()->_id }}">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title" type="text" placeholder="Product name" value="{{old('title')}}">
                                            @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>SKU <span class="text-danger">*</span></label>
                                            <input class="form-control" name="sku" type="text" placeholder="Product sku" value="{{old('sku')}}" required>
                                            @error('sku')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Short Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="short_description" placeholder="Short Description">{{old('short_description')}}</textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="brand_div">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Brands</label>
                                            <select name="brand" class="form-control">
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $key=>$brand)
                                                    <option value="{{$brand->_id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="price" step="0.01" placeholder="price" value="{{old('price')}}">
                                            @error('price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Sale Price </label>
                                            <input class="form-control" type="number" name="sale_price" step="0.01" placeholder="sale price" value="{{old('sale_price')}}">
                                            @error('sale_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="cat_div">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Category</label>
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $key=>$cat)
                                                    <option value="{{$cat->_id}}">{{$cat->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="price" placeholder="price" value="{{old('price')}}">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Product Rate</label>
                                            <input class="form-control" type="text" placeholder="Enter project Rate">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Product Type</label>
                                            <select class="form-select">
                                            <option>Hourly</option>
                                            <option>Fix price</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Priority</label>
                                            <select class="form-select">
                                            <option>Low</option>
                                            <option>Medium</option>
                                            <option>High</option>
                                            <option>Urgent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Project Size</label>
                                            <select class="form-select">
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Big</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Starting date</label>
                                            <input class="datepicker-here form-control" type="text" data-language="en">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label>Ending date</label>
                                            <input class="datepicker-here form-control" type="text" data-language="en">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Images <span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" name="images[]" multiple>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Description</label>
                                            <textarea class="form-control" name="description" placeholder="Full Description" id="" rows="5">{{old('description')}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="active">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <input type="submit" class="btn btn-success me-3 col-md-2" value="Add">
                                            <a class="btn btn-danger" href="{{route('products')}}">Cancel</a>
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