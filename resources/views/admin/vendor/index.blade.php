@extends('admin.layouts.master')
@section('page-title')
Vendors
@endsection
@section('mainContent')
<section class="content">
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
		        	<h1>Vendors</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
		         	<li class="breadcrumb-item active">Vedors</li>
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
                <table id="vendorlistadmin" class="table table-bordered table-striped">
                @endif
                <thead>
                  <tr>
                    <th>Vendor ID</th>
                    <!-- <th>First Name</th>
                    <th>Last Name</th> -->
                    <th>Business Email</th>
                    <!-- <th>Alternate No</th> -->
                    <th>Phone No</th>
                    
                    <th>Business Name</th>
                    <th>IP</th>
                    <!-- <th>CNIC</th> -->
                    <!-- <th>Business Address</th> -->
                    <!-- <th>State</th>
                    <th>City</th> -->
                    <td>Status</td>
                    <th>Action</th>
                    <td>Delete</td>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id=1; ?>
                    @foreach($vendors as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <!-- <td>{{$data->first_name}}</td>
                        <td>{{$data->last_name}}</td> -->
                        
                        <td>{{$data->business_email}}</td>
                        <!-- <td>{{$data->alternate_phone_no}}</td> -->
                        <td>{{$data->phone_no}}</td>
                        <!-- <td>{{$data->cnic}}</td> -->
                        <td>{{$data->business_name}}</td>
                        <td>{{$data->ip}}</td>
                        <!-- <td>{{$data->business_address}}</td> -->
                        <!-- <td>{{$data->state}}</td>
                        <td>{{$data->city}}</td> -->
                        <td><button class="btn btn-default">{{$data->status}}</button></td>
                        <td>
                            <a  style="margin-bottom:4px" href="/admin/showproduct?vendor_id={{$data->id}}" class="btn btn-info">
                              PRODUCTS
                            </a>
                            
                            <a style="margin-bottom:4px" class="btn btn-primary btn-md btn-block" href="/admin/vendors/edit/{{ $data->id }}">
                              Edit
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
                        <td>
                          <form id="formDelete" name="formDelete" method="post" action="/admin/vendor_delete/{{ $data->id }}/">
                            @csrf
                            {{ @method_field('delete') }}
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">DELETE</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <!-- <th>First Name</th>
                    <th>Last Name</th> -->
                    <th>Business Email</th>
                    <!-- <th>Alternate No</th> -->
                    <th>Phone No</th>
                    <!-- <th>CNIC</th> -->
                    <th>Business Name</th>
                    <th>IP</th>
                    <!-- <th>Business Address</th> -->
                    <!-- <th>State</th>
                    <th>City</th> -->
                    <td>Status</td>
                    <th>Action</th>
                    <td>Delete</td>
                  </tr>
                  </tfoot>
                </table>
             
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