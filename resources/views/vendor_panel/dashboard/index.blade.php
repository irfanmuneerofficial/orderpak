@extends('vendor_panel.layouts.master')
@section('title')
Dashboard
@endsection
@section('mainContent')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      @if(empty($shop->shop_img))
      <p class="alert alert-danger">Kindly upload logo to complete your shop detail.</p>
      @endif
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: darkblue;color:white">
              <div class="inner">
                <h3>{{$aproduct}}</h3>

                <p>Approved Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/product_approved" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: yellow;color:black">
              <div class="inner">
                <h3>{{$dproduct}}</h3>

                <p>Pending Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/product_pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: green;color:white">
              <div class="inner">
                <h3>{{$product}}</h3>

                <p>ALL Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: blue;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                        <?php $count++; ?>
                  @endforeach
                @endif

                <h3><?php echo $count++; ?> </h3>
                <p>All Product Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/orders" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: pink;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $pending = ''; 
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                    @if($order->status == 'In Process')
                      <?php $count++; ?>
                    @endif
                  @endforeach
                @endif
                <h3><?php echo $count++; ?> </h3>
                <p>In Process Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/order?status=In Process" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: orange;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $pending = ''; 
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                    @if($order->status == 'Pending')
                      <?php $count++; ?>
                    @endif
                  @endforeach
                @endif
                <h3><?php echo $count++; ?> </h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/order?status=Pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: gray;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $ship = ''; 
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                      @if($order->status == 'Ship')
                        <?php $count++; ?>
                      @endif
                  @endforeach
                @endif

                <h3><?php echo $count++; ?> </h3>
                <p>Ship Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/order?status=Ship" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: green;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $complete = ''; 
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                    @if($order->status == 'Complete')
                      <?php $count++; ?>
                    @endif
                  @endforeach
                @endif

                <h3><?php echo $count++; ?> </h3>
                <p>Complete Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/order?status=Complete" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: red;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $cancel = ''; 
                $unpaid_amount =0;
                ?> 
                @if($booked)
                  @foreach($booked as $order)
                    @if($order->status == 'Cancel')
                      <?php $count++; ?>
                    @endif
                @endforeach
                @endif

                <h3><?php echo $count++; ?> </h3>
                <p>Cancel Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/vendor/order?status=Cancel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
              <div class="info-box">
                <span class="info-box-icon bg-gradient-warning"><i class="ion-stats-bars"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Life Time Sale</span>
                  <span class="info-box-number">{{$payment_history}} <strong>PKR</strong></span>
                </div>
              </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary"><i class="fas fa-balance-scale"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending Wallet</span>
                  <span class="info-box-number">
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


        </div>




      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection