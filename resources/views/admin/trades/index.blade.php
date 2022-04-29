@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Trades list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Trades</li>
                        <li class="breadcrumb-item active">Trades list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header p-0" style="padding-bottom:10px !important;margin:5px 15px;">
                        <a href="{{route('trades.create')}}" class="btn btn-info btn-sm float-right ml-2 mt-2" title="Add Trade" style="float:right;">Create Trade</a>
                    </div>
                    <div class="card-body" style="padding-top:10px;">
                        <div class="table-responsive product-table">
                            @if(count($trades) > 0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Trade Name</th>
                                        <th>City</th>
                                        <th>Start Date</th>
                                        <th>Entry Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($trades as $trade)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <img src="{{$trade->image ? url($trade->image) : ''}}" alt="img" style="max-width: 64px;">
                                        </td>
                                        <td>
                                            <h6> {{$trade->title}} </h6>
                                        </td>
                                        <td>{{ $trade->city }}</td>
                                        <td>{{$trade->start_date}}</td>
                                        <td>${{ $trade->entry_amount }}</td>
                                        <td>{{ $trade->status }}</td>
                                        <td>
                                            <a href="{{route('trades.edit',$trade->_id)}}" class="btn btn-success" title="Edit Trade">Edit</a>
                                            <form method="POST" class="d-inline-block" action="{{route('trades.destroy',[$trade->_id])}}">
                                              @csrf 
                                              @method('delete')
                                                  <button class="btn btn-danger btn-sm dltBtn" data-id="{{$trade->_id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Trades found!!! Please add Trade</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
        

@endsection