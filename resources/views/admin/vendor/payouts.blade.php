@extends('admin.layouts.master')
@section('page-title')
Vendor's Bank Details
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
		        	<h1>Vendor's Payout Details</h1>
		      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
		          	<li class="breadcrumb-item"><a href="/">Home</a></li>
		         	<li class="breadcrumb-item active">Vedors</li>
		        </ol>
		    </div>
		</div>
	</div>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Account Title</th>
							<th>Account No</th>
							<th>Bank Name</th>
							<th>Branch Code</th>
						</tr>
					</thead>
					<tbody>
						<?php $id='1'; ?>
						@foreach($payouts as $row)
						<tr>
							<td>{{$id++}}</td>
							<td>{{$row->account_title}}</td>
							<td>{{$row->account_no}}</td>
							<td>{{$row->bank_name}}</td>
							<td>{{$row->branch_code}}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
                  <tr>
                    <th>ID</th>
					<th>Account Title</th>
					<th>Account No</th>
					<th>Bank Name</th>
					<th>Branch Code</th>
                  </tr>
                  </tfoot>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>
@endsection