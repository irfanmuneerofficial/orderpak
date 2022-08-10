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
            <h3 class="m-0 text-dark">Notification</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Notification</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header bg-success">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Vendor Alerts [ <span id='valert'>{{count($new_vendor_notifications)}}</span> ]
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                        @forelse($new_vendor_notifications as $notification)
                          <div class="callout callout-danger">
                            <!-- <h5><h5> -->
                            <p><strong>{{ $notification->data['name'] }}</strong> ({{ $notification->data['business_email'] }}) has just registered.[{{$notification->created_at->diffForHumans() }}] 
                            <!-- <a href="{{route('markNotification',$notification->id)}}" class="font-color:red">Mark as read</a> -->
                            <a class="btn btn-outline-danger" href="{{route('markNotification',$notification->id)}}" style="text-decoration:none" role="button">Mark as read</a>                            
                          </div>
                        @empty
                            There are no new notifications
                        @endforelse

                      </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header  bg-danger">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn ordcls"></i>
                  Order Alerts [ <span id='oalert'>{{count($new_order_notifications)}}</span> ]
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                        @forelse($new_order_notifications as $notification)
                          <div class="callout callout-success">
                            <p>Order#: <strong>{{ $notification->data['order_id'] }}</strong> ({{ $notification->data['name'] }}) has just ordered.[{{ $notification->created_at->diffForHumans() }}] 
                            <a class="btn btn-outline-success" href="{{route('markNotification',$notification->id)}}" style="text-decoration:none" role="button">Mark as read</a>                            
                          </p>
                          </div>
                        @empty
                            There are no new notifications
                        @endforelse                 
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
    </section>
  </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
    // function sendMarkRequest(id = null) {
    //   $.ajax({
    //           method: "GET",
    //           url: '/admin/markNotification/',
    //   success: function (response) 
    //   {
    //     $(this).parents('div.alert').remove();
    //   },                               
    //    });
    // }

    // $(function() {
    //     $('.mark-as-read').click(function() {
    //         let request = sendMarkRequest($(this).data('id'));
    //         request.done(() => {
    //             $(this).parents('div.alert').remove();
    //         });
    //     });
    // });
    </script>