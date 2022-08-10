@extends('user_panel.layouts.master')
@section('title')
Order History
@endsection
@section('mainContent')
  
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Order History</h4>
            <!--<p class="card-category"> Here is a subtitle for this table</p>-->
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table  id="myTable" class="table table-hover">
                <thead class="text-primary" style="width: 100%">
                  <th>Order No</th>
                  <th>Email</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @if($booked)
                  @foreach($booked as $order)
                    <tr>
                      <td>{{$order->order_id}}</td>
                      <td style="width:400px">{{$order->email}}</td>
                      <td>{{$order->amount}}</td>
                      {{-- <td><img src="/uploads/product_images/{{$order->product_img}}" width="100" alt=""></td> --}}
                      {{-- <td style="text-align:center;">
                        <a href="/admin/order/show/{{$order->order_id}}" class="btn btn-primary" style="border-radius: 35px;background-color: cyan; border-color: cyan;color:black;margin:10px">Detail</a>
                      </td> --}}
                      <td>{{$order->created_at}}</td>
                      <td><button class="btn btn-primary">{{$order->status}}</button></td>
                      <td><a href="/user/order/{{$order->order_id}}" class="btn btn-primary">Detail</a></td>
                    </tr>
                  @endforeach                  
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection