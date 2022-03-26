@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Product list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Product list</li>
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
                    <div class="card-header p-0" style="margin-left:85%;padding-top:10px;">
                        <a href="{{route('addproduct')}}" class="btn btn-info btn-sm float-right ml-2 mt-2" title="Add Product">Add Product</a>
                    </div>
                    <!-- <div class="float-right">
                        <a href="{{route('category.create')}}" class="btn btn-info">Add Category</a>
                    </div> -->
                    <div class="card-body" style="padding-top:10px;">
                        <div class="table-responsive product-table">
                            @if(count($products)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Added on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($products as $product)
                                    @php $category = $product->category; $brand = $product->brand; @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/ecommerce/product-table-1.png" alt="">
                                        </td>
                                        <td>
                                            <h6> {{$product->title}} </h6>
                                        </td>
                                        <td>{{ \App\Models\Category::where(['_id' => $category])->pluck('title')->first() }}</td>
                                        <td>${{$product->price}}</td>
                                        <td>{{$product->updated_at}}</td>
                                        <td>
                                            <a href="#" class="btn btn-success" title="Edit Product">Edit</a>
                                            <form method="POST" class="d-inline-block" action="#">
                                              @csrf 
                                              @method('delete')
                                                  <button class="btn btn-danger btn-sm dltBtn" data-id="{{$product->_id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Products found!!! Please add Product</h6>
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