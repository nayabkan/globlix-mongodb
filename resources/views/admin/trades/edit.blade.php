@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Edit Trade</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Trades</li>
                        <li class="breadcrumb-item active">Edit Trade</li>
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
                            <form action="{{route('trades.update',$trade->_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Trade Name <span class="text-danger">*</span></label>
                                            <input class="form-control" name="title" type="text" placeholder="Trade name" value="{{$trade->title}}">
                                            @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                        <label>Start Date <span class="text-danger">*</span></label>
                                            <input class="form-control digits" name="start_date" id="example-datetime-local-input" type="date" value="{{$trade->start_date}}">
                                            @error('start_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>End Date <span class="text-danger">*</span></label>
                                            <input class="form-control digits" name="expire_date" id="example-datetime-local-input" type="date" value="{{$trade->expire_date}}">
                                            @error('expire_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>City Name<span class="text-danger">*</span></label>
                                            <input class="form-control" name="city" type="text" placeholder="Trade City" value="{{$trade->city}}">
                                            @error('city')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Entry Amount <span class="text-danger">*</span></label>
                                            <input class="form-control digits" type="number" name="entry_amount" step="0.01" placeholder="Entry Amount" value="{{$trade->entry_amount}}">
                                            @error('entry_amount')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Full Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="address" placeholder="Trade Full Address" id="" rows="3">{{$trade->address}}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Trade Description</label>
                                            <textarea class="form-control" name="description" placeholder="Trade Description" id="">{{$trade->description}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Trade Banner <span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" name="image">
                                            <img src="{{ $trade->image ? url($trade->image) : ''}}" alt="" style="max-width: 64px;">
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Trade Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{(($trade->status=='active')? 'selected' : '')}}>Active</option>
                                                <option value="deactivate" {{(($trade->status=='deactivate')? 'selected' : '')}}>Deactivate</option>
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
                                            <a class="btn btn-danger" href="{{route('trades.index')}}">Cancel</a>
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