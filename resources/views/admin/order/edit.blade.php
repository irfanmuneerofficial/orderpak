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

  #cover {
  background: url("/frontend/Spinner-1s-200px.gif") no-repeat scroll center center;
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: 10;
}
</style>

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
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Edit Order </li>
        </ol>
        </div><!-- /.col -->
    </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-light">
          <h3 class="card-title"><b>Order Details</b></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form name="form-example-1" id="form-example-1" action="/admin/order/update/{{ $order->order_id }}/" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fullname">Order ID</label>
                            <input type="text" id="orderid" name="orderid" class="form-control" value="{{ $order->order_id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="total_cost">Total Cost</label>
                            <input type="text" id="total_cost" name="amount" class="form-control" value="{{ $order->amount }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">Shipping Cost</label>
                            <?php 
                                $ships = App\Models\OrderBook::class;
                                $shipping = $ships::where('order_id',request()->segment(4))->get()->max('shipping');
                            ?>
                            <input type="text" name="shipping" value="{{ $shipping }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <h4 class="text-center">Shipping & Billing Details</h4>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $order->name }}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $order->email }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text prepend-input" id="">+92</span>
                                </div>
                                <input maxlength="10" value="{{$order->phone_no}}" class="form-control input-phone" id="phone" name="phone" type="text" autocomplete="off" required="" placeholder="3456789048">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ $order->address }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control" value="{{ $order->state }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="{{ $order->city }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="zipcode">Postal Code</label>
                            <input type="text" id="zip" name="zipcode" class="form-control" value="{{ $order->zipcode }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                           <button type="submit" class="btn btn-primary" name="update_order">Update</button>
                           <a href="/admin/orders" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
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
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                    <div id="cover"></div>
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
                    <td>
                        <div class="product-quantity">
                            <input type="hidden" class="order_id" name="order_id" value="{{ $row->id }}">
                            <input type="hidden" class="pquantity" id="pquantity{{$row->product_id}}" name="pquantity" value="{{ $row->quantity }}">
                            <input type="hidden" class="pro_id" data-id="{{ $row->product_id }}" id="product_{{$row->product_id}}" name="product_id" value="{{ $row->product_id }}">
                            <span class="proprice_{{$row->product_id}}" id="@if($row->product_sale_price > 0){{ $row->product_sale_price}}@else {{$row->product_price}} @endif"></span>
                            <span style="cursor: pointer !important; cursor: auto;" class="minus">-</span>
                            <input class="number" disabled id="current_quantity_{{$row->product_id}}" type="number" max="{{$row->quantity}}" value="{{$row->quantity}}" min="1">
                            <span style="cursor: pointer !important; cursor: auto;" class="plus">+</span>
                            <span class="alert-danger" id="message{{$row->product_id}}"></span>
                        </div>
                    </td>
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
                    <td>RS: 
                        <span id="totalprice_{{ $row->product_id }}">
                            @if($row->product_sale_price) 
                                {{number_format($row->product_sale_price)}}
                            @else
                                {{number_format($row->product_price)}}
                            @endif
                        </span>
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


@push('order-edit-page')
<script type="text/javascript">

$('#phone').on('keyup',  function(e){
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

jQuery('#cover').hide();

  jQuery('.minus').click(function () {
    jQuery('#cover').show()
    var $inputid = jQuery(this).parent().find('.pro_id').data('id');
    var order_id = jQuery(this).parent().find('.order_id').val();
    var product_price = 0;
    var total_cost = 0;

    jQuery.get('/admin/order/get_quantity/'+$inputid, function( quantity ) {
        var $pquantity = quantity;
        var currentVal = jQuery('#current_quantity_'+$inputid).val();
        currentVal--;
        
        if (currentVal <= 0) {
            jQuery('#cover').hide();
            // Increment
            jQuery(this).val("+").css('color','#aaa');
            jQuery(this).val("+").css('cursor','not-allowed');
            jQuery('#message'+$inputid).html('Minimun Quantity 1')
            
        } else {
            jQuery('#message'+$inputid).html('');
            jQuery.get('/admin/order/subtract_quantity/'+$inputid+'/'+order_id, function( response ) {
                var updatequantity = Number(currentVal) * response.product_price; 
                jQuery('#totalprice_'+$inputid).html(updatequantity);
                jQuery('#total_cost').val(response.total_cost);

                jQuery("body").load('/admin/order/edit/'+{{ $order->order_id }} , function() {
                    // Animate loader off screen
                    jQuery('#cover').fadeOut(100);
                });
                return false;
            });

            jQuery('#current_quantity_'+$inputid).val(parseInt(currentVal));
        }
    });
 });

  jQuery('.plus').click(function () {
    
    jQuery('#cover').show()

    var $inputid = jQuery(this).parent().find('.pro_id').data('id');
    var order_id = jQuery(this).parent().find('.order_id').val();
    var product_price = 0;

    jQuery.get('/admin/order/get_quantity/'+$inputid, function( quantity ) {
        var $pquantity = quantity;
        var currentVal = jQuery('#current_quantity_'+$inputid).val();
        currentVal++;
        // alert($pquantity);
        if ($pquantity <= 0) {
            jQuery('#cover').hide();
            // Increment
            jQuery(this).val("+").css('color','#aaa');
            jQuery(this).val("+").css('cursor','not-allowed');
            jQuery('#message'+$inputid).html('Stock Limit ' + $pquantity)
            
        } else {
            jQuery('#message'+$inputid).html('');
            jQuery.get('/admin/order/addcart_quantity/'+$inputid+'/'+order_id, function( response ) {
                var updatequantity = Number(currentVal) * response.product_price; 
                jQuery('#totalprice_'+$inputid).html(updatequantity);
                jQuery('#total_cost').val(response.total_cost);
                
                jQuery("body").load('/admin/order/edit/'+{{ $order->order_id }} , function() {
                    // Animate loader off screen
                    jQuery('#cover').fadeOut(100);
                });
                return false;
            });

            jQuery('#current_quantity_'+$inputid).val(parseInt(currentVal));
        }
    });
  });


</script>
@endpush
