@extends('vendor_panel.layouts.master')
@section('title')
Manage Orders
@endsection
@section('mainContent')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $statys = $_GET['status'] ?> Orders</h1>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="table-responsive">
              <?php 
                 $categorymodel = new App\Models\Category;
                 $parentcategorymodel = new App\Models\ParentCategory;
                 $childcategorymodel = new App\Models\ChildCategory;
              ?>

                <table id="example1" class="table table-hover table-bordered">
                  <thead>
                  <tr>
                    <th>OrderID</th>
                    <th>Customer Name</th>
                    {{-- <th>Amount</th> --}}
                    {{-- <th>SKU</th> --}}
                    <!--<th>Email</th>-->

                    <!--<th>Name</th>-->
                    <!--<th>Contact No</th>-->
                    {{-- <th>Quantity</th> --}}
                    {{-- <th>Color</th> --}}
                    {{-- <th>Size</th> --}}
                    {{-- <th>Commission</th> --}}
                    {{-- <th>Price</th> --}}
                    <th>Date</th>
                    <!--<th>Shipping Address</th>-->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty(json_decode($orders)))
                        @foreach($orders as $order)
                        {{-- @if($cart->id == $order->cart_id) --}}
                                <tr>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{$order->name}}</td>
                                    {{-- <td><img src="/uploads/product_images/{{$order->product_img}}" width="100" alt=""></td> --}}
                                    {{-- <td>{{$order->vendor_id}}-{{$order->category_id}}-{{$order->product_sku}}</td> --}}
                                    <!--<td>{{$order->email}}</td>-->
                                    
                                    <!--<td>{{$order->name}}</td>-->
                                    <!--<td>{{$order->phone}}</td>-->
                                    {{-- <td>{{$order->quantity}}</td> --}}
                                    {{-- <td>{{$order->color}}</td> --}}
                                    {{-- <td>{{$order->size}}</td> --}}
                                    {{-- <td>
                                    <?php 
                                        $commission = App\Models\Commission::class;
                                        $mailcommissions = $commission::where('category_id', $order->category_id)->where('parent_id', $order->parent_id)->where('child_id',$order->child_id)->first();
                                      ?>
                                       @if(!empty($mailcommissions->child_rate))
                                        {{$mailcommissions->child_rate .'%'}}
                                      @elseif(!empty($mailcommissions->parent_id))
                                        {{$mailcommissions->parent_rate .'%'}} 
                                      @elseif(!empty($mailcommissions->category_id))
                                          {{$mailcommissions->main_rate .'%'}}
                                      @endif
                                    </td> --}}
                                    {{-- <td> 
                                      @if($order->product_sale_price)
                                      {{$order->product_sale_price}}</td>
                                      @else
                                      {{$order->product_price}}</td>
                                      @endif
                                    </td> --}}
                                    <td>{{$order->created_at}}</td>
                                    <!--<td>{{$order->address}}</td>-->
                                    <td>

                                        {{-- <a href="/vendor/order/print/{{$order->id}}?product_id={{$order->product_id}}" class="btn btn-default ">View Print</a> <br>  --}}
                                      <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <?php 
                                                //$commission = App\Models\OrderBook::class;
                                                //$mailcommissions = $commission::where('vendor_id', Auth::guard('vendor')->user()->id)->where('order_id',$order->order_id)->first();
                                              ?>

                                              {{$order->status}}
                                            </button>
                                            @if($order->status == 'Pending')
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="/vendor/order/{{$order->order_id}}?status=In Process&vendor_id={{ Auth::user('vendor')->id }}">Process</a>
                                            </div>
                                            @endif
                                          </div>
                                    </td>
                                    {{-- <td><button class="btn btn-primary">{{$order->status}}</button></td> --}}
                                    <td><a href="/vendor/order_show/{{$order->order_id}}" class="btn btn-primary">Detail</a></td>
                                </tr>
                            {{-- @endif --}}
                        @endforeach

                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>OrderID</th>
                    <th>Customer Name</th>
                    {{-- <th>Amount</th> --}}
                    {{-- <th>SKU</th> --}}
                    <!--<th>Email</th>-->

                    <!--<th>Name</th>-->
                    <!--<th>Contact No</th>-->
                    {{-- <th>Quantity</th> --}}
                    {{-- <th>Color</th> --}}
                    {{-- <th>Size</th> --}}
                    {{-- <th>Commission</th> --}}
                    {{-- <th>Price</th> --}}
                    <th>Date</th>
                    <!--<th>Shipping Address</th>-->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
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