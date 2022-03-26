@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Brand</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Brands</li>
                        <li class="breadcrumb-item active">Edit Brand</li>
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
                            <form action="{{route('brands.update',$brands->_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Brand Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title" value="{{$brands->title}}">
                                            @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Brand Image <span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" name="image">
                                            <img src="{{ $brands->image ? url($brands->image) : ''}}" alt="" style="max-width: 64px;">
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="{{$brands->status}}">
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