@extends('admin/layouts/layout')
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Category list</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active">Category list</li>
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
                        <a href="{{route('category.create')}}" class="btn btn-info btn-sm float-right ml-2 mt-2" title="Add Category">Add Category</a>
                    </div>
                    <div class="card-body" style="padding-top:10px;">
                        <div class="table-responsive product-table">
                        @if(count($categories)>0)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Is Parent</th>
                                        <th>Parent Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1; @endphp
                                    @foreach($categories as $category)
                                    @php $parent_id = $category->parent_id; @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            <img src="{{$category->image ? url($category->image) : ''}}" alt="" style="max-width: 64px;">
                                        </td>
                                        <td>
                                            <h6> {{$category->title}} </h6>
                                        </td>
                                        <td>{{(($category->is_parent==1)? 'Yes': 'No')}}</td>
                                        <td>{{ \App\Models\Category::where(['_id' => $parent_id])->pluck('title')->first() }}</td>
                                        @if($category->status=='active')
                                            <td class="font-success">{{$category->status}}</td>
                                        @else
                                            <td class="font-warning">{{$category->status}}</td>
                                        @endif
                                        <td>
                                            <a href="{{route('category.edit',$category->_id)}}" class="btn btn-success" title="Edit Category">Edit</a>
                                            <form method="POST" class="d-inline-block" action="{{route('category.destroy',[$category->_id])}}">
                                              @csrf 
                                              @method('delete')
                                                  <button class="btn btn-danger btn-sm dltBtn" data-id="{{$category->_id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @php $sl++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h6 class="text-center">No Categories found!!! Please create Category</h6>
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