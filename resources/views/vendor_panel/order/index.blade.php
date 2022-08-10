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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                    {{-- @if(!empty(json_decode($booked))) --}}

                        @foreach($booked as $order)
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
                        @endforeach
                    {{-- @endif --}}
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>OrderID</th>
                    <th>Customer Name</th>
                    {{-- <th>Product Image</th> --}}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // // Categories get
    get_category_data()
    function get_category_data() {
      $.ajax({
            url: '/admin/commission_category/',
            type:'GET',
          dataType: 'json',
          success: function (result) {
                $.each(result, function (i, value) {
                    $('#category_id').append('<option value=' + JSON.stringify(value.id) + '>' + JSON.stringify(value.title) + '</option>');
                    $('#editcategory_id').append('<option value=' + JSON.stringify(value.id) + '>' + JSON.stringify(value.title) + '</option>');
                });
            },
      });
    }

//Save data into database
 $('#comment').on('submit', function(e) {
  $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    event.preventDefault()
    var formData = new FormData(this);
    $.ajax({
      url: '/admin/commission/',
      type: "POST",
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (data) {
        swal({title: "Good job", text: "You clicked the button!", type: 
          "success"}).then(function(){ 
             location.reload();
             }
          );
        // $('#comment').trigger("reset");
        // jQuery.noConflict();
        // $('#modal-id').modal('hide');

      },
      error: function (data) {
          console.log('Error......');
      }
  });
});

//Edit modal window
// $('body').on('click', '#editSliders', function (event) {
//     event.preventDefault();
//     var id = $(this).data('id');
   
//     $.get('/admin/commission/'+ id+'/edit', function (data) {
//          alert(data);
//          $('#userCrudModall').html("Edit company");
//          $('#submitt').val("Edit Commission");
//          $('#modal-idd').modal('show');
//          $('#editrate').val(data.rate);
//      });
//   });

  // Update record
  //Save data into database
 // $('#updateform').on('submit', function(e) {
// $('body').on('submit', '#updateform', function (e) {
$('#updateform').on('submit', function(e) {

    event.preventDefault()
    var id = $("#sliderid").val();
    var name = $("#editname").val();
    var title = $("#edittitle").val();
    var description = $("#editdescription").val();
    var link = $("#editlink").val();
    var slider_img = $("#editslider_img").val();
   
    $.ajax({
      url: '/admin/commission/'+id+'/',
      type: "PUT",
      cache: false,
      enctype: 'multipart/form-data',
      data: {
        name: name,
        title: title,
        link: link,
        description: description,
        slider_img: slider_img,
        _token:'{{ csrf_token() }}'
      },
      // data: $('form').serialize(),
      dataType: 'json',
      success: function (data) {
        swal("Good job!", "You clicked the button!", "success");  
        $('#comment').trigger("reset");
        jQuery.noConflict();
        $('#modal-idd').modal('hide');
        get_company_data();
        if(dataResult.statusCode)
         {
            window.location = "/admin/sliders";
         }
         else{
             alert("Internal Server Error");
         }
      },
      error: function (data) {
          alert('Error......');
      }
  });
});

 //DeleteCompany
 $('body').on('click', '#deleteCompany', function (event) {
    swal({
      title: "Are you sure Want to delete this?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

        event.preventDefault();
        var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

        $.ajax(
          {
            url: '/admin/commission/'+id+'/',
            type: 'DELETE',
            data: {
                  id: id,
                  "_token": token,
            },
            success: function (response){
            
              swal("Poof! Your has been deleted!", {
                icon: "success",
              });
              location.reload(true);
            }
          });
        } 
        else {
          swal("Your Data is safe!");
        }
      });
    });
  }); 

  
</script>
{{-- <script src="/js/ajax.js"></script> --}}

@endpush