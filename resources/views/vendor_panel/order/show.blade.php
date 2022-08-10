@extends('vendor_panel.layouts.master')
@section('title')
Order History
@endsection

@section('mainContent')

<div class="container">
    <div class="row">
        
        @if(!empty($order->shipment_info))
        <div class="col-md-6 col-sm-6">
          <span><b>Tracking Number</b></span>
          <input id="tracking_number" type="hidden" name="tracking_number" value="{{ $order->shipment_info['consignment_number'] }}" />
          <a class="btn btn-info" id="tracking" href="{{ url('/vendor/order/gettrackinginfo/'.$order->shipment_info['consignment_number']) }}">{{ $order->shipment_info['consignment_number'] }}</a>
        </div>
        @endif
    </div>

 <div class="row">
    <div class="col-12">
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
                <td class="text-right">
                  <button class="btn btn-info " type="button">
                      {{$order->status}}
                  </button>
                      {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/vendor/order/{{$order->order_id}}?status=In Process">Process</a>
                      </div> --}}
                </td>
              </tr>
              <tr>
                <td><b>View Invoice</b></td>
                <td>:</td>
                <td class="text-right"><a href="/vendor/order/print/{{$order->order_id}}?product_id={{$order->product_id}}" class="btn btn-info" ><i class="fa fa-eye"></i></a></td>
              </tr>
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  
  <div class="row">
      <!--<div class="col-6"> -->
      <!--  <div class="card">-->
      <!--      <div class="card-header bg-light">-->
      <!--        <h3 class="card-title"><b>Shipping Details</b></h3>-->
      <!--      </div>-->
            <!-- /.card-header -->
      <!--      <div class="card-body p-0">-->
      <!--          <table class="table table-sm">-->
      <!--            <tbody>-->
      <!--              <tr>-->
      <!--                <td><b>Name</b></td>-->
      <!--                <td>:</td>-->
      <!--                <td class="text-right">{{$order->name}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--                <td><b>Email</b></td>-->
      <!--                <td>:</td>-->
      <!--                <td class="text-right">{{$order->email}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--                <td><b>Phone</b></td>-->
      <!--                <td>:</td>-->
      <!--                <td class="text-right">{{$order->phone_no}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--                <td><b>Address</b></td>-->
      <!--                <td>:</td>-->
      <!--                <td class="text-right">{{$order->address}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--                <td><b>State</b></td>-->
      <!--                <td>:</td>-->
      <!--                <td class="text-right">{{$order->state}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--              <td><b>City</b></td>-->
      <!--              <td>:</td>-->
      <!--              <td class="text-right">{{$order->city}}</td>-->
      <!--              </tr>-->
      <!--              <tr>-->
      <!--              <td><b>Postal Code</b></td>-->
      <!--              <td>:</td>-->
      <!--              <td class="text-right">{{$order->zipcode}}</td>-->
      <!--              </tr>-->
      <!--            </tbody>-->
      <!--          </table>-->
      <!--        </div>-->
              <!-- /.card-body -->
      <!--      </div>-->
      <!--</div>-->
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
                    <th>Product Sku</th>
                    <th>Systematic Sku</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    {{-- <th>Status</th> --}}
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
                    <td>{{$row->vendor_id}}-{{$row->category_id}}-{{$row->product_sku}}</td>
                    <td>{{$row->systematic_sku}}</td>
                    <td>{{$row->quantity}}</td>
                    <td>{{$row->size}}</td>
                    <td><p style="background-color: {{$row->color}}">{{ ($row->color == 'undefined') ? 'undefined' :$row->color }}&nbsp;</p></td>
                    <td>RS : @if($row->product_sale_price > 0 ){{number_format($row->product_sale_price)}} @else {{number_format($row->product_price)}} @endif</td>
                    <td>RS : @if($row->product_sale_price > 0 ){{number_format($row->quantity * $row->product_sale_price)}} @else {{number_format($row->quantity * $row->product_price)}} @endif</td>
                    {{-- <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{$row->status}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="/vendor/order/{{$row->id}}?status=In Process&product_id={{$row->product_id}}&order_id={{ $row->order_id }}">Process</a>
                        </div>
                      </div>
                    </td> --}}
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