@extends('admin.layouts.master')
@section('page-title')
    Payment Transfer
@endsection
@section('mainContent')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Payment Transfer</h1>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>

        <section class="content">
            @if (count($errors) > 0)
                <x-admin.alert type="danger" :message="$errors"/>
            @elseif(session('success'))
                <x-admin.alert type="success" :message="[]"/>
            @endif
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="{{url('/admin/payment_transfer')}}/" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order#</label>
                                        <select id="order_id" name="order_id" class="form-control" onchange="change_order_vendor(this.value)">
                                        <option value="">Select</option>
                                             @foreach($orders as $key => $attr)  
                                                @if($attr!='')
                                                    <option value="{{$attr->order_id}}">{{$attr->order_id}} [ {{$attr->name}} ]</option>
                                                @endif  
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Shop Name</label>
                                        <select name="shop_name" id="input" class="form-control" required="required">
                                        <option value='0'>-- Select Vendor --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="attachment">Attach File</label>
                                        <input type="file" name="file" class="form-control" id="attachment">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount">Total Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" id="start_date"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" class="form-control" id="end_date"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="payment_status">Payment status</label>
                                        <input type="text" name="status" class="form-control"
                                               value="Process" id="payment_status" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/admin/orders" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success float-right">Submit Payment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

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
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment Status</th>
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
                          <td>{{$order->created_at}}</td>
                          <!--<td><button class="btn btn-primary">{{$order->status}}</button></td>-->
                          <td>
                          {{$order->status}}
                            <a href="/admin/order/show/{{$order->order_id}}" class="btn btn-primary" style="border-radius: 35px;background-color: cyan; border-color: cyan;color:black;margin:10px">Detail</a>
                          </td>
                          <td>{{$order->vpay_status}}</td>
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
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment Status</th>                    
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
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
function change_order_vendor(order_id)
{
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var url = "{{URL('/admin/payment/order')}}";
    // var id = order_id;
    var dltUrl = url;
    // Empty the dropdown
    $('#input').find('option').not(':first').remove();
    $.ajax({
        type:'get',
        url:dltUrl,
        data:{order_id:order_id},
        success:function(response)
        {
            var len = 0;
            if(response['data'] != null){
            len = response['data'].length;
            }

            if(len > 0)
            {
                // Read data and create <option >
                for(var i=0; i<len; i++)
                {
                    var id = response['data'][i].id;
                    var name = response['data'][i].business_name;
                    var option = "<option value='"+id+"'>"+name+"</option>";
                    $("#input").append(option); 
                }
            }
          // alert(color);
        }
    });
    // return false;
}
</script>