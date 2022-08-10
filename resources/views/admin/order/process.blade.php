@extends('admin.layouts.master')
@section('page-title')
Manage Orders
@endsection

@section('status')
{{$status}}
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ ($status =='Pending' ) ? 'New' : $status  }} Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">{{$status}} Orders </li>
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
                    <th>Name</th>
                    <th>Customer Email</th>
                    <th>Total Cost</th>
                    <!--<th>Status</th>-->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty(json_decode($orders)))
                        @foreach($orders as $order)
                                <tr>
                          <td>{{$order->order_id}}</td>
                          <td>{{$order->name}}</td>
                          <td>{{$order->email}}</td>
                          <td>{{$order->amount}}</td>
                          <!--<td><button class="btn btn-primary">{{$order->status}}</button></td>-->
                          <td>
                            <a href="/admin/order/show/{{$order->order_id}}" class="btn btn-primary" style="border-radius: 35px;background-color: cyan; border-color: cyan;color:black;margin:10px">Detail</a>
                          </td>
                          
                        </tr>
                        @endforeach

                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>OrderID</th>
                    <th>Name</th>
                    <th>Customer Email</th>
                    <th>Total Cost</th>
                    <!--<th>Status</th>-->
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