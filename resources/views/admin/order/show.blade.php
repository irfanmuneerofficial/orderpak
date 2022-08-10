@extends('admin.layouts.master')
@section('page-title')
Order
@endsection
@section('mainContent')

<style>
  .btn-generate {
    padding: 3px 17px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #545454;
    background-color: #ffbf47;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px #999;
    font-weight: bold;
  }
  .form-back .btn-generate:hover{
    background-color: #ffa805;
  }
</style>

<div class="content-wrapper">
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
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
<div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
            <a href="/admin/order/edit/{{ $order->order_id }}" class="btn btn-primary">Update Order</a> 
        </div>
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
                    <td class="text-right">{{count($orders)}}</td>
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
                        $shipping = $ships::where('order_id',request()->segment(4))->get()->max('shipping');
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
                    <td><b>View Invoice</b></td>
                    <td>:</td>
                    <td class="text-right"><a href="/admin/order/print/{{$order->order_id}}?product_id={{$order->product_id}}" class="btn btn-info" ><i class="fa fa-eye"></i></a></td>
                  </tr>
                </tbody>
            </table>
            <div class="container pt-3 pl-4 pb-3">
                <div class="row"> 
                    <div class="col-4"> 
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$order->status}}
                            </button>
                            @if($porder == '0')
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/admin/orderr/{{$order->order_id}}?status=Ship">Shiping</a>
                                <a class="dropdown-item" href="/admin/orderr/{{$order->order_id}}?status=Cancel">Cancel</a>
                                <a class="dropdown-item" href="/admin/orderr/{{$order->order_id}}?status=Complete">Complete</a>
                              </div>
                            @endif
                          </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        
          <div class="{{ (empty($orders[0]->shipment_info))? 'col-md-6' : 'col-md-4'}}">
            <div class="card">
              <div class="card-header bg-light">
                <h3 class="card-title"><b>@if(empty($orders[0]->shipment_info)) Booking Shipment @else Track Order  @endif</b></h3>
              </div>
              <div class="card-body">
              @if(empty($orders[0]->shipment_info))
                <form id="generateMPtrack" name="generateMPtrack" method="post" class="form-back" action="/admin/order/generate/" autocomplete="off">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->order_id}}" />
                    <input type="hidden" name="items" value="{{count($orders)}}" />
                    <input type="hidden" name="amount" value="{{$order->amount}}" />
                    <input type="hidden" name="name" value="{{$order->name}}" />
                    <input type="hidden" name="email" value="{{$order->email}}" />
                    <input type="hidden" name="phone" value="{{$order->phone_no}}" />
                    <input type="hidden" name="address" value="{{$order->address}}" />
                    <input type="hidden" name="city" value="{{$order->city}}" />
                    <input type="hidden" name="zipcode" value="{{$order->zipcode}}" />
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="weight">Weight</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">KG</span>
                            </div>
                            <input type="text" id="weight" name="weight" class="form-control" placeholder="0.1">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="service_type">Service Type</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-shipping-fast"></i></span>
                              </div>
                              <select name="service_type" id="service_type" class="form-control">
                                <option value="O">Overnight</option>
                                <option value="S">Second Day</option>
                              </select>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <button type="submit"  class="btn btn-warning btn-block" name="generate_mp" id="generate_mp">Generate M&P Shipment</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  @else
                  <div class="row">
                    <div class="col-md-12">
                        <h6><b>Tracking Number</b></h6>
                        <!-- <span><b>Tracking Number</b></span> -->
                        <input id="tracking_number" type="hidden" name="tracking_number" value="{{ $orders[0]->shipment_info->consignment_number }}" />
                        <a class="btn btn-info btn-md btn-block" id="tracking" href="{{ url('/admin/order/gettrackinginfo/'.$orders[0]->shipment_info->consignment_number) }}">{{ $orders[0]->shipment_info->consignment_number }}</a>
                    </div>
                  </div>
                  @endif
              </div>
            </div>
          </div>
    </div>
    <div class="row">
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
                  <td class="text-right">{{$order->phone_no}}</td>
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
                      <td class="text-right">{{$order->phone_no}}</td>
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
                    <th>Product ID#</th>
                    <th>Shop Name</th>
                    <th>Status</th>
                    <th>Product Title</th>
                    <th>Systematic Sku</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Commission</th>
                    <th>Status</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                     $vendors = new App\Models\Vendor;
                  ?>
                  @if($orders)
                  @foreach($orders as $row)
                  <?php  $vendor = $vendors::find($row->vendor_id); ?>
                  <?php // $pcategory = $parentcategorymodel::find($order->parent_id); ?>
                  <?php // $ccategory = $childcategorymodel::find($order->child_id); ?>
                  <tr>
                    <td>{{$row->product_id}}</td>
                    <td>{{$vendor->business_name}}</td>
                    <td>{{$row->status}}</td>
                    <td>{{$row->product_name}}</td>
                    <td>{{$row->systematic_sku}}</td>
                    <td>{{$row->quantity}}</td>
                    <td>{{$row->size}}</td>
                    <td><p style="background-color: {{$row->color}}">{{ ($row->color == 'undefined') ? 'undefined' :'' }}&nbsp;</p></td>
                    <td>
                        <?php 
                          $commission = App\Models\Commission::class;
                          $mmailcommissions = $commission::where('category_id', $row->category_id)->first();
                          $pmailcommissions = $commission::where('parent_id', $row->parent_id)->first();
                          $cmailcommissions = $commission::where('child_id',$row->child_id)->first();
                        ?>
                         @if(!empty($cmailcommissions->child_rate))
                          {{$cmailcommissions->child_rate .'%'}}
                        @elseif(!empty($pmailcommissions->parent_id))
                          {{$pmailcommissions->parent_rate .'%'}} 
                        @elseif(!empty($mmailcommissions->category_id))
                            {{$mmailcommissions->main_rate .'%'}}
                        @endif
                    </td>
                    <td>{{$row->status}}</td>
                    <td>RS : @if($row->product_sale_price > 0) 
                        {{number_format($row->product_sale_price)}}
                    @else
                        {{number_format($row->product_price)}}
                    @endif
                    </td>
                    <td>RS : @if($row->product_sale_price > 0) 
                        {{number_format($row->quantity * $row->product_sale_price)}}
                    @else
                        {{number_format($row->quantity * $row->product_price)}}
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

<div id="modalTracking" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection


@push('page-show')
<script type="text/javascript">

	$(document).ready(function(){
    jQuery('a#trackings').click(function(e){
      e.preventDefault();
      jQuery.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="_token"]').attr('content')
          }
      });
      // jQuery('#modalTracking').modal('show');
      jQuery.ajax({
          type: "GET",
          url: '{{ url('/admin/order/gettrackinginfo') }}',
          data:{ 'consignment_number': jQuery('#tracking_number').val() },
          success: function(response) {
            console.log(response.response[0]['CN']);
            // Add response in Modal body
            jQuery('.modal-body').html(response.response[0]['CN']);

            // Display Modal
            jQuery('#modalTracking').modal('show');
          }
      });
    });
  });

  $('#weight').on('input', function () {
    this.value = this.value.match(/^\d+\.?\d{0,2}/);
  });

  $("#generateMPtrack").submit(function (e) {
    jQuery('#generate_mp').prop('disabled', true);
    jQuery('#generate_mp').text('Generating...');
  });

</script>
@endpush