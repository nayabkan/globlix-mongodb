@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Create User</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Create User</li>
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
                            <form action="#" method="post" type="multipart/form-date">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>User FullName <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" placeholder="User fullname" value="{{old('name')}}">
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>User Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" placeholder="example@email.com" value="{{old('email')}}">
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>User Mobile <span class="text-danger">*</span></label>
                                            <input class="form-control" type="tel" name="mobile" placeholder="User Mobile" value="{{old('mobile')}}">
                                            @error('mobile')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="dob">User DOB <span class="text-danger">*</span></label>
                                            <input class="form-control" id="dob" type="number" name="dob" value="{{old('dob')}}">
                                            @error('dob')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>User Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="address">User Address <span class="text-danger">*</span></label>
                                            <textarea name="address" rows="5" class="form-control" id="address" placeholder="User Full Address">{{old('dob')}}</textarea>
                                            @error('address')
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