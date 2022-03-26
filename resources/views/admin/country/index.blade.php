@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Country list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Countries</li>
                        <li class="breadcrumb-item active">Country list</li>
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
                    <div class="card-body">
                        <div class="table-responsive product-table">
                        @if(count($country)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($country as $countr)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <h6> {{$countr->name}} </h6>
                                        </td>
                                        <td>{{ $countr->code }}</td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No country found!!!</h6>
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