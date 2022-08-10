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
		        	<h1>Deactive Vendors</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
		         	<li class="breadcrumb-item active">Deactive Vedors</li>
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
                    @foreach($vendors as $data)
                      <tr @if($data->blocked_ip) style="background: {{ $data->blocked_ip->color_code }}; color:#fff;" @endif>
                        <td>{{$data->id}}</td>
                        <td>{{$data->first_name}} {{$data->last_name}}</td>
                        <td>{{$data->business_email}}</td>
                        <td>{{$data->phone_no}}</td>
                        <td>{{$data->cnic}}</td>
                        <td>{{$data->business_name}}</td>
                        <td>{{$data->ip}}</td>
                        <td>
                          @if($data->blocked_ip)
                            <a id="unblock_ip_btn_{{ $data->blocked_ip->id }}" href="/admin/vendor/unblock/{{ $data->blocked_ip->id }}" class="btn btn-default unblock_ip_btn">
                              Un-Block IP
                            </a>
                          @else
                            @if($data->ip)
                              <input class="vendor_id" type="hidden" name="vendor_id" value="{{ $data->id }}" />
                              <input class="ip_address" type="hidden" name="ip_address" value="{{ $data->ip }}" />
                              <a id="block_ip_btn_{{ $data->id }}" href="javascript:;" class="btn btn-warning block_ip_btn">
                                Blocked IP
                              </a>
                            @endif
                            <a href="/admin/showproduct?vendor_id={{$data->id}}" class="btn btn-info">
                              PRODUCTS
                            </a>
                            <form id="formDelete" name="formDelete" method="post" action="/admin/vendor_delete/{{ $data->id }}/">
                                @csrf
                                {{ @method_field('delete') }}
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">DELETE</button>
                              </form>
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
                            @endif
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

@push('deactive-vendor-page-script')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $('body').on('click', '.block_ip_btn', function(e){
    e.preventDefault();
    var href = jQuery(this).attr('href');
    var vendor_id = jQuery(this).siblings('.vendor_id').val();
    var ip_address = jQuery(this).siblings('.ip_address').val();

    jQuery.ajax({
        url: "/admin/vendor/blocked/",
        type:"POST",
        data:{
          vendor_id: vendor_id,
          ip_address: ip_address
        },
        success:function(response){
          
          if(response) {
            window.location.reload();
          }
        },
       });
  });

</script>
@endpush