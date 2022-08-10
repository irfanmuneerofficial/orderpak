@extends('admin.layouts.master')
@section('page-title')
Manage Orders
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Orders </li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      @if (count($errors) > 0)
        <x-admin.alert type="danger" :message="$errors"/>
      @elseif(session('success'))
        <x-admin.alert type="success" :message="[]"/>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="/admin/payment/transfer" class="btn btn-default ">Payment Transfer</a>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="example2">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Vendor Name</th>
                      <th>Amount</th>
                      <th>Slip Image</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($payments as $payment)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>
                        @foreach($vendors as $vendor)
                        @if($vendor->id == $payment->vendor_id)
                          {{$vendor->business_name}}
                          @endif
                        @endforeach
                      </td>
                      <td>PKR: {{$payment->amount}}</td>
                      <td><img src="/uploads/admin/payment_transfer/{{$payment->file}}" width="100"></td>
                      <td>{{$payment->sdate}}</td>
                      <td>{{$payment->edate}}</td>
                      <td>
                        <form method="post" action="/admin/payment/{{ $payment->id }}/">
                          {{ csrf_field() }}
                          {{ method_field('delete') }}
                          <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection  

@push('ajax_crud')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

@endpush