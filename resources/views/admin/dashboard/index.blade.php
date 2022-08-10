@extends('admin.layouts.master')
@section('page-title')
Dashboard
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Dashboard</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h3>Vendors</h3>
        <hr>
        <div class="row">
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: green;color:white">
              <div class="inner">
                <h3>{{$avendor}}</h3>
                <p>Total Activate Vendors</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/admin/vendor/active" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: red;color:white">
              <div class="inner">
                <h3>{{$dvendor}}</h3>
                <p>Deactive Vendor</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/vendor/deactive" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: orange;color:white">
              <div class="inner">
                <h3>{{$suspendvendors}}</h3>
                <p>Suspend Vendors</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/vendor/suspend" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          
         </div
          <br>
          <h3>Products</h3>
          <hr>
          <!-- ./col -->
          <div class="row">
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: purple;color:white">
              <div class="inner">
                <h3>{{$product}}</h3>
                <p>All Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/admin/products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: darkblue;color:white">
              <div class="inner">
                <h3>{{$aproduct}}</h3>
                <p>Approved Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/product/approved" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: yellow;color:black">
              <div class="inner">
                <h3>{{$pproduct}}</h3>
                <p>Pending Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/product/pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          
          
          <div class="col-lg-2 col-2">
            <div class="small-box" style="background-color: #8B4513;color:white">
              <div class="inner">
                <h3>{{$latest}}</h3>
                <p>Latest Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/admin/product/latest" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        
            <br>
            <h3>Orders</h3>
            <hr>
            <div class="row">
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: blue;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $process = ''; 
                ?>
                <h3>{{$torders}} </h3>
                <p>All Product Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/orders" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: orange;color:white">
              <div class="inner">
                <?php 
                $count = 0; 
                $process = ''; 
                ?>

                <h3>{{$porders}} </h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/order/pending?status=Pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: pink;color:white">
              <div class="inner">
                <h3>{{ $iporders  }} </h3>
                <p>In Process Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/order/process?status=In Process" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: gray;color:white">
              <div class="inner">
                <h3>{{$sorders}} </h3>
                <p>Ship Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/order/ship?status=Ship" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: green;color:white">
              <div class="inner">
                <h3>{{$corders}}</h3>
                <p>Complete Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/order/complete?status=Complete" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box" style="background-color: red;color:white">
              <div class="inner">
                <h3>{{$cancelorders}} </h3>
                <p>Cancel Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/order/cancel?status=Cancel" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <br>
          <h3>Order Status</h3>
          <hr>
          <!-- ./col -->
          <div class="row">
            <div class="col-lg-2 col-2">
            <div class="small-box bg-warning" >
              <div class="inner">
                <h3>{{$corderspayment}}</h3>
                <p><strong>Order Total Amount</strong></p>
              </div>
              <div class="icon">
              <i class="fas fa-chart-bar"></i>              
              </div>
              <!-- <a href="/admin/products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <div class="col-lg-2 col-2">
            <div class="small-box bg-info" >
              <div class="inner">
                <h3>{{$cordersunpaid}}</h3>
                <p>Order Pending Payment</p>
              </div>
              <div class="icon">
              <i class="fas fa-chart-pie"></i>
              </div>
              <!-- <a href="/admin/products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>


      </div>
    </section>
  </div>
@endsection