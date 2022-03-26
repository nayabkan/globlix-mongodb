@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Category</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
                            <form action="" method="post" type="multipart/form-date">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Category Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title" value="{{$category->title}}">
                                            @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-check-inline checkbox checkbox-dark mb-3">
                                            <input class="form-check-input" id="is_parent" type="checkbox" name="is_parent" value='{{$category->is_parent}}' {{(($category->is_parent==1)? 'checked' : '')}}>
                                            <label class="form-check-label" for="is_parent">Is Parent</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="parent_cat_div">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Parent Category</label>
                                            <select name="parent_id" class="form-control">
                                                <option value="">Select Parent Category</option>
                                                @foreach($parent_cats as $key=>$parent_cat)
                                                    <option value="{{$parent_cat->id}} {{(($parent_cat->id==$category->parent_id) ? 'selected' : '')}}">{{$parent_cat->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="{{$category->status}}">
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