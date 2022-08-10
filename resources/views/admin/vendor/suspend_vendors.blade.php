@extends('admin.layouts.master')
@section('page-title')
Deactive Vendor
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
		        	<h1>Suspend Vendors</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
		         	<li class="breadcrumb-item active">Suspend Vedors</li>
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
                @if(Auth::guard('admin')->user()->fullname == 'jhon')
                  <table id="dataexample" class="table table-bordered table-striped">
                @else
                <table id="example1" class="table table-bordered table-striped">
                @endif
                <thead>
                  <tr>
                    <th>Vendor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Business Email</th>
                    <th>Alternate No</th>
                    <th>Phone No</th>
                    <th>CNIC</th>
                    <th>Business Name</th>
                    <th>Business Address</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Delete</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id=1; ?>
                    @foreach($vendors as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->last_name}}</td>
                        
                        <td>{{$data->business_email}}</td>
                        <td>{{$data->alternate_phone_no}}</td>
                        <td>{{$data->phone_no}}</td>
                        <td>{{$data->cnic}}</td>
                        <td>{{$data->business_name}}</td>
                        <td>{{$data->business_address}}</td>
                        <td>{{$data->state}}</td>
                        <td>{{$data->city}}</td>
                        <td>
                          <form id="formDelete" name="formDelete" method="post" action="/admin/vendor_delete/{{ $data->id }}/">
                            @csrf
                            {{ @method_field('delete') }}
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">DELETE</button>
                          </form>
                        </td>
                        <td><button class="btn btn-default">{{$data->status}}</button></td>
                         <td>
                            <!--<a href="/admin/showproduct?vendor_id={{$data->id}}" class="btn btn-info btn-sm">-->
                            <!--  PRODUCTS-->
                            <!--</a>-->
                          <!--@if($data->status=='DEACTIVE')-->
                          <!--  <a href="/admin/vendor_status?id={{$data->id}}" class="btn btn-danger btn-sm">-->
                          <!--    DEACTIVE-->
                          <!--  </a>-->
                          <!--@elseif($data->status=='ACTIVE')-->
                          <!--  <a href="/admin/vendor_status?id={{$data->id}}" class="btn btn-success btn-sm">-->
                          <!--    ACTIVE-->
                          <!--  </a>-->
                          <!--@elseif($data->status=='PENDING')-->
                          <!--<a href="/admin/vendor_status?id={{$data->id}}" class="btn btn-warning btn-sm">-->
                          <!--  PENDING-->
                          <!--</a>-->
                          <!--@elseif($data->status=='SUSPEND')-->
                          <!--<a href="/admin/vendor_status?id={{$data->id}}" class="btn btn-warning btn-sm">-->
                          <!--  SUSPEND-->
                          <!--</a>-->
                          <!--@endif-->
                          <a href="/admin/showproduct?vendor_id={{$data->id}}" class="btn btn-info">
                              PRODUCTS
                            </a>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default">Action</button>
                              <button type="button" id="dropdownSubMenu1" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div aria-labelledby="dropdownSubMenu1" class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="/admin/vendor_status?id={{$data->id}}&status=ACTIVE">ACTIVE</a>
                                <a class="dropdown-item" href="/admin/vendor_status?id={{$data->id}}&status=DEACTIVE">DEACTIVE</a>
                                <a class="dropdown-item" href="/admin/vendor_status?id={{$data->id}}&status=PENDING">PENDING</a>
                                <a class="dropdown-item" href="/admin/vendor_status?id={{$data->id}}&status=SUSPEND">SUSPEND</a>
                                
                            </div>
                        </td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Business Email</th>
                    <th>Alternate No</th>
                    <th>Phone No</th>
                    <th>CNIC</th>
                    <th>Business Name</th>
                    <th>Business Address</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Delete</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                {{ $vendors->links() }}
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
    <!--</div>-->
@endsection