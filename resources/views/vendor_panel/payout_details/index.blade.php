@extends('vendor_panel.layouts.master')
@section('title')
Payout Details
@endsection
@section('vendor-panel')
	<!-- Hero section start -->
	<section class="content">
<div class="box">
  <div class="box-body">
	<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Add Payout Details</a> <hr>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ url('/vendor/payout') }}/" enctype="multipart/form-data" class="form" method="POST" role="form">
					@csrf
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">First Name</label>
							<input type="hidden" name="vendor_id" class="form-control" value="{{Auth::guard('vendors')->user()->id}}" id="" placeholder="Input field">
							<input type="text" name="first_name" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-6">
							<label for="">Last Name</label>
							<input type="text" name="last_name" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">Date Of Birth</label>
							<input type="date" name="date_of_birth" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-6">
							<label for="">Complete SSN</label>
							<input type="text" name="ssn" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-6">
							<label for="">ID Front</label>
							<input type="file" name="id_front" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-6">
							<label for="">ID Back</label>
							<input type="file" name="id_back" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-12">
						<label for="">Address</label>
						<input type="text" name="address" class="form-control" id="" placeholder="Input field">
					</div>
					</div>
					<div class="form-group col-md-12">
						<div class="form-group col-md-4">
							<label for="">Country</label>
							<input type="text" name="country" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-4">
							<label for="">Rounting No</label>
							<input type="text" name="routing_no" class="form-control" id="" placeholder="Input field">
						</div>
						<div class="form-group col-md-4">
							<label for="">Account No</label>
							<input type="text" name="account_no" class="form-control" id="" placeholder="Input field">
						</div>
					</div>
					
						<button type="submit" class="btn btn-primary col-md-12">Submit</button>
						<div>&nbsp;</div>
					</form>
				</div>
				<div class="modal-footer"><br>
					<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>FUll Name</th>
							<th>Date OF Birth</th>
							<th>SSN</th>
							<th>ID Front</th>
							<th>ID Back</th>
							<th>Address</th>
							<th>Country</th>
							<th>Routing No</th>
							<th>Account NO</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $id='1'; ?>
						@foreach($details as $row)
						<tr>
							<td>{{$id++}}</td>
							<td>{{$row->first_name}} {{$row->last_name}}</td>
							<td>{{$row->date_of_birth}}</td>
							<td>{{$row->ssn}}</td>
							<td><img src="/uploads/{{$row->front_id}}" width="100"></td>
							<td><img src="/uploads/{{$row->back_id}}" width="100"></td>
							<td>{{$row->address}}</td>
							<td>{{$row->country}}</td>
							<td>{{$row->routing_no}}</td>
							<td>{{$row->account_no}}</td>
							<td>
								<form method="post" action="{{ url('/vendor/payout/' + $row->id) }}/">
				                    {{ csrf_field() }}
				                    {{ method_field('delete') }}
				                    <a href="/vendor/payout/{{ $row->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
				                    <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
				                 </form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</section>


@endsection