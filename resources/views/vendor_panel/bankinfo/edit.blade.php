@extends('vendor_panel.layouts.master')
@section('title')
Edit Bank Info
@endsection
@section('mainContent')
<div class="content-header">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
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
        <h1 class="m-0 text-dark">Bank Info</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Bank Info</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </div>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <form action="{{url('/vendor/payout/'.$data->id)}}/" enctype="multipart/form-data" class="form" method="POST" role="form">
					@csrf
					@method('put')
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="">Account Title</label>
							<input type="text" name="account_title" value="{{$data->account_title}}" class="form-control" id="" placeholder="Input field" required>
						</div>
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="">Account No</label>
							<input type="number" name="account_no" value="{{$data->account_no}}" class="form-control" id="" placeholder="Input field" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="">Bank Name</label>
							<input type="text" name="bank_name" value="{{$data->bank_name}}" class="form-control" id="" placeholder="Input field" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="">Branch Code</label>
							<input type="number" name="branch_code" value="{{$data->branch_code}}" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					
						<button type="submit" class="btn btn-primary col-md-12">Submit</button>
						<div>&nbsp;</div>
					</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection