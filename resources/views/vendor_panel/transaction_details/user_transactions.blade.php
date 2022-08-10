@extends('vendor_panel.layouts.master')
@section('vendor-panel')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>User Transactions</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->
        @if($userTransactions)
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead style="background-color: #F8F8F8;">
                <tr>
                  <th>Transaction ID</th>
                  <th>User Name</th>
                  <th>Vehicle Type</th>
                  <th>Cleaning Type</th>
                  <th>Wheeler</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Payment Created at</th>
                  {{-- <th>Receipt</th> --}}
                </tr>
              </thead>
              @foreach($userTransactions as $userTransaction)
              <tr>
                <td>{{ $userTransaction->gateway_transaction_id }}</td>
                <td>{{ $userTransaction->user->username }}</td>
                <td>{{ $userTransaction->vehicle_id }}</td>
                <td>{{ $userTransaction->cleaning_id }}</td>
                <td>{{ $userTransaction->wheeler_id }}</td>
                @foreach($checkAvailability as $availability)
                  @if($userTransaction->caid == $availability->id)
                    <td>{{ $availability->time }}</td>
                    <td>{{ $availability->date }}</td>
                  @endif
                @endforeach
                <td>{{ $userTransaction->created_at }}</td>
                {{-- <td><a href="{{ $userTransaction->payment_receipt }}" class="btn btn-primary">Receipt</a></td> --}}
              </tr>
              @endforeach
            </table>
        @else
            <div class="alert alert-danger">
                No record found!
            </div>
        @endif
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

@endsection
