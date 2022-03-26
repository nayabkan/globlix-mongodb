@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Profile</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Admin</li>
                        <li class="breadcrumb-item active"> Edit Profile</li>
                    </ol>
                </div>
              </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">My Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <!-- <form action="" method="post">  -->
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media"><img class="img-70 rounded-circle" alt="" src="{{ url('/') }}/admin/assets/images/user/7.jpg">
                              <div class="media-body">
                                <h5 class="mb-1">{{ Auth::guard('admin')->user()->name }}</h5>
                                <p>Administrator</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email-Address</label>
                          <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input class="form-control" type="password" placeholder="********" readonly="">
                        </div>
                        <!-- <div class="form-footer">
                          <button class="btn btn-primary btn-block">Save</button>
                        </div> -->
                      <!-- </form> -->
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <form class="card" action="" method="post">
                      @csrf
                    <div class="card-header">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input class="form-control" name="email" type="email" value="{{ Auth::guard('admin')->user()->email }}" required>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input class="form-control" name="name" type="text" value="{{ Auth::guard('admin')->user()->name }}" required>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="*********" required>
                            <span>Input New password and click save to change password.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


@endsection