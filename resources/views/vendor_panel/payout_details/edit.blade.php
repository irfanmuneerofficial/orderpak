@extends('vendor_panel.layouts.master')
@section('vendor-panel')
	<!-- Hero section start -->
	<section class="content">
		<div class="box">
		 	<div class="box-body">
		 		<form action="{{ url('/vendor/payout/'+ $detail->id)) }}/" enctype="multipart/form-data" class="form" method="POST" role="form">
					@csrf
      				{{ method_field('put') }}
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">First Name</label>
							<input type="text" name="first_name" value="{{$detail->first_name}}" class="form-control" id="" >
						</div>
						<div class="form-group col-md-6">
							<label for="">Last Name</label>
							<input type="text" name="last_name" value="{{$detail->last_name}}" class="form-control" id="" >
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">Date Of Birth</label>
							<input type="date" name="date_of_birth" value="{{$detail->date_of_birth}}" class="form-control" id="">
						</div>
						<div class="form-group col-md-6">
							<label for="">Complete SSN</label>
							<input type="text" name="ssn" value="{{$detail->ssn}}" class="form-control" id="" >
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">ID Front</label>
							<input type="file" name="id_front" class="form-control" id="" >
						</div>
						<div class="form-group col-md-6">
							<label for="">ID Back</label>
							<input type="file" name="id_back" class="form-control" id="" >
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-12">
						<label for="">Address</label>
						<input type="text" name="address" value="{{$detail->address}}" class="form-control" id="" >
					</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-4">
							<label for="">Country</label>
							<input type="text" name="country" value="{{$detail->country}}" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-4">
							<label for="">Rounting No</label>
							<input type="text" name="routing_no" value="{{$detail->routing_no}}" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-4">
							<label for="">Account No</label>
							<input type="text" name="account_no" value="{{$detail->account_no}}" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					
						<button type="submit" class="btn btn-primary col-md-12">Submit</button>
						<div>&nbsp;</div>
					</form>
			</div>
		</div>

	</section>


@endsection