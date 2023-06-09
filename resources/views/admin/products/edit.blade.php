@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Product</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                            <form action="{{route('updateproduct',$product->_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- <input name="user_id" type="hidden" value="{{ $product->user_id }}"> -->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title" type="text" placeholder="Product name" value="{{$product->title}}">
                                            @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>SKU <span class="text-danger">*</span></label>
                                            <input class="form-control" name="sku" type="text" placeholder="Product sku" value="{{$product->sku}}" required>
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
                                            <textarea class="form-control" name="short_description" placeholder="Short Description" rows="3">{{$product->short_description}}</textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="is_featured">Is Featured</label><br>
                                            <input type="checkbox" name='is_featured' class="" id='is_featured' {{(($product->is_featured=='on')? 'checked' : '')}}> Yes                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="white_labeled">White Label</label><br>
                                            <input type="checkbox" name='white_label' class="" id='white_labeled' {{(($product->white_label=='on')? 'checked' : '')}}> Yes                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="brand_div">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Brands</label>
                                            <select name="brand" class="form-control">
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $key=>$brand)
                                                    <option value="{{$brand->_id}}" {{(($product->brand==$brand->_id)? 'selected' : '')}}>{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Category</label>
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $key=>$cat)
                                                    <option value="{{$cat->_id}}" {{(($product->category==$cat->_id) ? 'selected' : '')}}>{{$cat->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Country</label>
                                            <select name="country" class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $key=>$country)
                                                    <option value="{{$country->code}}" {{(($product->country==$country->code) ? 'selected' : '')}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input class="form-control digits" type="number" name="price" step="0.01" placeholder="price" value="{{$product->price}}">
                                            @error('price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Sale Price </label>
                                            <input class="form-control digits" type="number" name="sale_price" step="0.01" placeholder="sale price" value="{{$product->sale_price}}">
                                            @error('sale_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Images <span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" name="images[]" multiple>
                                            <span>
                                                @foreach(json_decode($product->images) as $glimg)
                                                    <img src="{{$glimg ? url($glimg) : ''}}" style="max-width: 64px;">
                                                @endforeach
                                            </span>
                                            @error('images')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Product Description</label>
                                            <textarea class="form-control ckeditor" name="description" placeholder="Full Description" id="">{{$product->description}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Vendor Name <span class="text-danger">*</span></label>
                                            <select name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $key=>$vendor)
                                                    <option value="{{$vendor->_id}}" {{(($product->vendor_id==$vendor->_id)? 'selected' : '')}}>{{$vendor->firstname}} {{$vendor->lastname}}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Product Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
                                                <option value="deactivate" {{(($product->status=='deactivate')? 'selected' : '')}}>Deactivate</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <input type="submit" class="btn btn-success me-3 col-md-2" value="Update">
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