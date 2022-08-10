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
    <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
	<section class="content-header">
	 	<div class="container-fluid">
	    	<div class="row mb-2">
		    	<div class="col-sm-6">
		        	<h1>Blocked Ips</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
		         	<li class="breadcrumb-item active">Blocked Ips</li>
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
                    <th>Name</th>
                    <th>Business Email</th>
                    <th>Phone No</th>
                    <th>CNIC</th>
                    <th>Business Name</th>
                    <th>IP</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($blocked_ips as $data)
                      <tr style="background: {{ $data->color_code }}; color:#fff;">
                        <td>{{$data->vendor->id}}</td>
                        <td>{{$data->vendor->first_name}} {{$data->vendor->last_name}}</td>
                        <td>{{$data->vendor->business_email}}</td>
                        <td>{{$data->vendor->phone_no}}</td>
                        <td>{{$data->vendor->cnic}}</td>
                        <td>{{$data->vendor->business_name}}</td>
                        <td>{{$data->ip}}</td>
                        <td>
                            <a id="unblock_ip_btn_{{ $data->id }}" href="/admin/vendor/unblock/{{ $data->id }}" class="btn btn-default unblock_ip_btn">
                                Un-Block IP
                            </a>
                        </td>
                      </tr>
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Business Email</th>
                    <th>Phone No</th>
                    <th>CNIC</th>
                    <th>Business Name</th>
                    <th>IP</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                {{ $blocked_ips->links() }}
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