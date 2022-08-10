@extends('vendor_panel.layouts.master')
@section('title')
Wallet
@endsection
@section('mainContent')
	<!-- Hero section start -->
	<section class="content">
      <div class="container-fluid">
      <br>
        <div class="row">
        <div class="col-lg-4 col-3">&nbsp;</div>
        <div class="col-lg-2 col-3">
              <div class="info-box">
                <span class="info-box-icon bg-gradient-warning"><i class="ion-stats-bars"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Life Time Sale</span>
                  <span class="info-box-number">{{$payment_history}} <strong>PKR</strong></span>
                </div>
              </div>
          </div>

          <div class="col-lg-2 col-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary"><i class="fas fa-balance-scale"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending Wallet</span>
                  <span class="info-box-number">
                    <?php $unpaid_amount =0; ?>
                  @if($payment_pending)
                  @foreach($payment_pending as $unpaid)
                    @if($unpaid->product_sale_price == 0)
                      <?php $unpaid_amount += $unpaid->product_price; ?>
                    @else
                      <?php $unpaid_amount += $unpaid->product_sale_price; ?>
                    @endif
                @endforeach
                {{$unpaid_amount}} <strong>PKR</strong>
                @endif
                  </span>
                </div>
            </div>
          </div>
          <div class="col-lg-4 col-3">&nbsp;</div>

        </div>
        
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
<!--               <div class="card-header">
                {{-- <h3 class="card-title">DataTable with default features</h3> --}}
                <div class="col-lg-2" style="background-color: lightgrey;width: 170px;border: 2px solid black;padding: 40px;float: right ">
      					Wallet<br><b>PKR : @if($myamount =='')0 @else{{$myamount}} @endif</b> 
    				    </div>
              </div>
 -->              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
					<tr>
						<th>ID</th>
                        <!--<th>Order ID</th>-->
                        <th>Vendor Name</th>
                        <!--<th>Product Name</th>-->
                        <th>Amount</th>
                        <th>Slip Image</th>
                        <th>Start Date</th>
                        <th>End Date</th>
						<!--<th>Action</th>-->
					</tr>
                  </thead>
                  <tbody>
                  	<?php $id='1'; ?>
						@foreach($myamountdetails as $payment)
						<tr>
                          <td>{{$id++}}</td>
                          <!--<td>{{$payment->order_id}}</td>-->
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
                        </tr>
						@endforeach
                  </tbody>
                  <tfoot>
					<tr>
						<th>ID</th>
                        <th>Order ID</th>
                        <th>Vendor Name</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Slip Image</th>
						<!--<th>Action</th>-->
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


@endsection