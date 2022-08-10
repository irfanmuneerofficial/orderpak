@extends('user_panel.layouts.master')
@section('title')
User Dashboard 
@endsection

@section('mainContent')

<div class="container">
      <div class="row">
           
                @if(!empty($order->shipment_info))
                @php
                  $consignment_number = $order->shipment_info['consignment_number']
                @endphp
                <div class="col-md-6 col-sm-6">
                  <span><b>Tracking Number</b></span>
                  <input id="tracking_number" type="hidden" name="tracking_number" value="{{ $order->shipment_info['consignment_number'] }}" />
                  <a class="btn btn-info" id="tracking" href="{{ url('/user/order/gettrackinginfo/'.$order->shipment_info['consignment_number']) }}">{{ $order->shipment_info['consignment_number'] }}</a>
                </div>
                @endif
        </div>

  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header bg-light">
          <h3 class="card-title"><b>Order Details</b></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-sm">
            <tbody>
              <tr>
                <td><b>Order ID</b></td>
                <td>:</td>
                <td class="text-right">{{$order->order_id}}</td>
              </tr>
              <tr>
                <td><b>Total Product</b></td>
                <td>:</td>
                <td class="text-right">{{count($orderrs)}}</td>
              </tr>
              <tr>
                <td><b>Total Cost</b></td>
                <td>:</td>
                <td class="text-right">RS : {{number_format($order->amount)}}</td>
              </tr>
              
              <tr>
                <td><b>Shipping</b></td>
                <td>:</td>
                <td class="text-right">RS : 
                <?php 
                    $ships = App\Models\OrderBook::class;
                    $shipping = $ships::where('order_id',request()->segment(3))->get()->max('shipping');
                ?>
                {{number_format($shipping)}}
                </td>
              </tr>
              
              <tr>
                <td><b>Ordered Date</b></td>
                <td>:</td>
                <td class="text-right">{{$order->created_at}}</td>
              </tr>
              <tr>
                <td><b>Payment Method</b></td>
                <td>:</td>
                <td class="text-right">Cash On Delivery</td>
              </tr>
              <tr>
                <td><b>Status</b></td>
                <td>:</td>
                <td class="text-right"><button class="btn btn-info" type="button">{{$order->status}}</button></td>
              </tr>
            </tbody>
        </table>
        {{-- <div class="container pt-3 pl-4 pb-3">
              Status
            <div class="row"> 
                <div class="col-4"> 
                    
                </div>
            </div>
        </div> --}}
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-header bg-light">
          <h3 class="card-title"><b>Billing Details</b></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td><b>Name</b></td>
                  <td>:</td>
                  <td class="text-right">{{$order->name}}</td>
                </tr>
                <tr>
                  <td><b>Email</b></td>
                  <td>:</td>
                  <td class="text-right">{{$order->email}}</td>
                </tr>
                <tr>
                  <td><b>Phone</b></td>
                  <td>:</td>
                  <td class="text-right">{{$order->phone}}</td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td>:</td>
                  <td class="text-right">{{$order->address}}</td>
                </tr>
                <tr>
                  <td><b>State</b></td>
                  <td>:</td>
                  <td class="text-right">{{$order->state}}</td>
                </tr>
                <tr>
                <td><b>City</b></td>
                <td>:</td>
                <td class="text-right">{{$order->city}}</td>
                </tr>
                <tr>
                <td><b>Postal Code</b></td>
                <td>:</td>
                <td class="text-right">{{$order->zipcode}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-6"> 
        <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title"><b>Shipping Details</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <td><b>Name</b></td>
                      <td>:</td>
                      <td class="text-right">{{$order->name}}</td>
                    </tr>
                    <tr>
                      <td><b>Email</b></td>
                      <td>:</td>
                      <td class="text-right">{{$order->email}}</td>
                    </tr>
                    <tr>
                      <td><b>Phone</b></td>
                      <td>:</td>
                      <td class="text-right">{{$order->phone}}</td>
                    </tr>
                    <tr>
                      <td><b>Address</b></td>
                      <td>:</td>
                      <td class="text-right">{{$order->address}}</td>
                    </tr>
                    <tr>
                      <td><b>State</b></td>
                      <td>:</td>
                      <td class="text-right">{{$order->state}}</td>
                    </tr>
                    <tr>
                    <td><b>City</b></td>
                    <td>:</td>
                    <td class="text-right">{{$order->city}}</td>
                    </tr>
                    <tr>
                    <td><b>Postal Code</b></td>
                    <td>:</td>
                    <td class="text-right">{{$order->zipcode}}</td>
                    </tr>
                    <tr>
                    <td><b>Message</b></td>
                    <td>:</td>
                    <td class="text-right">{{$order->message}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
  </div>
  <div class="row"> 
    <div class="col-12"> 
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products Ordered</h3>

              {{-- <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    {{-- <th>Product ID#</th> --}}
                    <th>Shop Name</th>
                    <th>Status</th>
                    <th>Product Title</th>
                    <th>Sku</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                     $vendors = new App\Models\Vendor;
                  ?>
                  @if($orderrs)
                  @foreach($orderrs as $row)
                  <?php  $vendor = $vendors::find($row->vendor_id);?>
                  <?php // $pcategory = $parentcategorymodel::find($order->parent_id); ?>
                  <?php // $ccategory = $childcategorymodel::find($order->child_id); ?>
                  <tr>
                    {{-- <td>{{$row->product_id}}</td> --}}
                    <td>{{$vendor->business_name}}</td>
                    <td>{{$row->status}}</td>
                    <td>{{$row->product_name}}</td>
                    <td>{{$row->systematic_sku ? $systematic_sku : $row->vendor_id.'-'.$row->category_id.'-'.$row->product_sku}}</td>
                    <td>{{$row->quantity}}</td>
                    <td>{{$row->size}}</td>
                    <td><p style="background-color: {{$row->color}}">{{ ($row->color == 'undefined') ? 'undefined' :'' }}&nbsp;</p></td>
                    <td>RS : @if($row->product_sale_price) 
                                {{number_format($row->product_sale_price)}}
                            @else
                                {{number_format($row->product_price)}}
                            @endif
                            </td>
                  </tr>
                  @endforeach                  
                  @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
  </div>
</div>
</div>
      
@endsection