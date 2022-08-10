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
                        <h1 class="m-0 text-dark">{{ucfirst($_REQUEST['status'])}} Payment List</h1>
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
                  @if(!empty(json_decode($payments)))
                        @foreach($payments as $order)
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