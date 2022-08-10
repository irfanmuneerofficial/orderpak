@extends('admin.layouts.master')
@section('page-title')
Vendor's Products
@endsection
@section('mainContent')
<div class="content-wrapper">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Sorry!</strong> There were more problems.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
	<section class="content-header">
	 	<div class="container-fluid">
	    	<div class="row mb-2">
		    	<div class="col-sm-6">
		        	<h1>Product</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="#">Home</a></li>
		         	<li class="breadcrumb-item active">Product</li>
		        </ol>
		    </div>
		</div>
	</div>
<!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
         	<div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">DataTable with default features</h3> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    {{--<?php $id=1; ?>--}}
                    @foreach($products as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>
                            @foreach($categories as $category)
                            @if($category->id == $data->category_id)
                            {{$category->title}}
                            @endif
                            @endforeach
                            > 
                            @foreach($pcategories as $pcategory)
                            @if($pcategory->id == $data->parent_id)
                            {{$pcategory->title}}
                            @endif
                            @endforeach
                            >
                            @foreach($ccategories as $ccategory)
                            @if($ccategory->id == $data->child_id)
                            {{$ccategory->title}}
                            @endif
                            @endforeach
                        </td>
                        <td><img src="/uploads/product_images/{{$data->image_1}}" width="50" alt=""></td>
                        <td>{{$data->price}}</td>
                        <td>{!! $data->product_description !!}</td>
                        <td>{{$data->created_at}}</td>
                        
                        <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default">Action</button>
                              <button type="button" id="dropdownSubMenu1" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div aria-labelledby="dropdownSubMenu1" class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="/product/{{$data->slug}}">VIEW</a>
                                <a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=APPROVED">APPROVED</a>
                                <a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=PENDING">PENDING</a>
                                <a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=REJECTED">REJECTED</a>
                                
                            </div>
                        </td>
                        <td><button class="btn btn-default">{{$data->admin_status}}</button></td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Product Image</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
                {{ $products->appends(['vendor_id' => $_GET['vendor_id']])->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    </div>
@endsection