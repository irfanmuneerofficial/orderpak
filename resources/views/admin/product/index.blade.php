@extends('admin.layouts.master')
@section('page-title')
Vendor's Products
@endsection
@section('mainContent')
<div class="content-wrapper">
	<section class="content-header">
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
	 	<div class="container-fluid">
	    	<div class="row mb-2">
		    	<div class="col-sm-6">
		        	<h1>Product</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <!--<th>Product Image</th>-->
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Add Keyword</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    {{--<?php $id=1; ?>--}}
                    @foreach($products as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>
                          <strong>{{ $data->category->title ?? '' }}</strong> > 
                          {{ $data->pCategory->title ?? '' }} >
                          {{ $data->cCategory->title ?? '' }}
                            {{-- @foreach($categories as $category)
                            @if($category->id == $data->category_id)
                            {{$category->title}}>
                            break;
                            @endif
                            
                            @if($category->id == $data->category_id)
                            {{$category->title}}>
                            @endif
                            
                            @if($category->id == $data->category_id)
                            {{$category->title}}
                            @endif
                            @endforeach --}}
                             
                            {{-- @foreach($pcategories as $pcategory)
                            @if($pcategory->id == $data->parent_id)
                            {{$pcategory->title}}
                            @endif
                            @endforeach --}}
                            
                            {{-- @foreach($ccategories as $ccategory)
                            @if($ccategory->id == $data->child_id)
                            {{$ccategory->title}}
                            @endif
                            @endforeach --}}
                        </td>
                        <!--<td><img src="/uploads/product_images/{{$data->image_1}}" width="50" alt=""></td>-->
                        <td>{{$data->price}}</td>
                        <td>{{$data->sale_price}}</td>
                        <td>{!!$data->short_description!!}</td>
                        <td>{{$data->created_at}}</td>
                        <td>    
                        <form id="keyword_box" name="keyword_box" method="post" action="/admin/products/titlekeyword/{{ $data->id }}/">
                          @csrf
                          <input class="p_title_keyword" type="text" name="product_title_keyword" value="{{ $data->product_title_keyword }}">
                          <input type="hidden" name="pro_id" value="{{ $data->id }}">
                          <input type="hidden" name="vendor_id" value="{{ $data->vendor_id }}">
                          <button type="submit" class="badge badge-danger btn-sm">
                            <i class="fas fa-trash">
                            </i>
                            Save
                          </button>
                        </form>
                        </td>
                        <td><button class="btn btn-default">{{$data->admin_status}}</button></td>
                        <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default">Action</button>
                              <button type="button" id="dropdownSubMenu1" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div aria-labelledby="dropdownSubMenu1" class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="/product/{{$data->slug}}">VIEW</a>
                                <a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=APPROVED">APPROVED</a>
                                <a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=REJECTED">REJECTED</a>
                                <!--<a class="dropdown-item" href="/admin/product_status/{{$data->id}}?status=PENDING">PENDING</a>-->
                                
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <!--<th>Product Image</th>-->
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                {{ $products->links() }}
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

@push('admin_prodcut_index')
<script>
  $(".p_title_keyword").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
  });

  function isValid(str) {
      return !/[~`!@#$%\^&*()+=\[\]\\';,/{}|\\":<>\?]/g.test(str);
  }
</script>
@endpush