@extends('vendor_panel.layouts.master')
@section('title')
Manage Orders
@endsection
@section('mainContent')

<style>
    .table-bordered td {
        text-align: center;
    }
    .shipment-table td.title {
        color: #f26522;
    }
</style>

    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Track Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Track  Result</li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      @if($tracking[0]->isSuccess == 'true')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="table-responsive">
                            <table class="col-md-12 table table-bordered table-condensed cf">
                            <tbody>
                                <tr>
                                    <td data-title="Booking" class="title">
                                        <strong> Booking Date :</strong>
                                    </td>
                                    <td data-title="Date">
                                        {{ $tracking[0]->tracking_Details[0]->BookingDate }}                          
                                    </td>
                                    <td data-title="consignmentNumber" class="title">
                                        <strong> Consignment Number:</strong>
                                    </td>
                                    <td data-title="Cn">
                                        {{ $tracking[0]->tracking_Details[0]->CN }}                          
                                    </td>
                                    <td data-title="From -> To" class="title">
                                        <strong> From -&gt; To </strong>
                                    </td>
                                    <td data-title="destination" class="numeric">
                                    {{ $tracking[0]->tracking_Details[0]->Origin }} -&gt; {{ $tracking[0]->tracking_Details[0]->Destination }}                         
                                    </td>
                                </tr>
                                <tr>
                                    <td data-title="Booking" class="title">
                                        <strong> International Tracking No :</strong>
                                    </td>
                                    <td data-title="Date"></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card track-result">
                    <div class="card-header track-result-inner">
                        <div class="table-responsive shipment-details">
                            <h4>Shipment Details</h4>
                            <table class="col-md-12 table table-bordered table-condensed cf shipment-table">
                                <tbody>
                                <tr class="fact_table_row dark">
                                    <td data-title="shipper" class="title">Shipper:</td>
                                    <td data-title="shipper-name">
                                        {{ $tracking[0]->tracking_Details[0]->Shipper }}                        
                                    </td>
                                    <td data-title="consignee" class="title" >Shipper Address:</td>
                                    <td data-title="consignee-name" colspan="5">
                                        {{ $tracking[0]->tracking_Details[0]->ShipperAdd ? $tracking[0]->tracking_Details[0]->ShipperAdd : 'Plot No. 219, Street No. 7, Sector i-9/2, Industrial Area, Islamabad' }}                        
                                    </td>

                                </tr>
                                <tr class="fact_table_row dark">
                                    <td data-title="shipper" class="title">Consignee:</td>
                                    <td data-title="shipper-name">
                                        {{ $tracking[0]->tracking_Details[0]->Consignee }}                        
                                    </td>

                                    <td data-title="consignee" class="title">Weight</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->weight }} KG                       
                                    </td>
                                    <td data-title="consignee" class="title">Pieces</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->pieces }}                       
                                    </td>
                                    <td data-title="consignee" class="title">Service Type</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->ServiceType }}                        
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="table-responsive">
                <h4>Tracking History</h4>
                <table id="" class="table table-hover table-bordered">
                  <thead>
                  <tr>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Date & Time</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Location</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Status</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Detail Status</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
                    @foreach($tracking[0]->tracking_Details[0]->Details as $detail)
                    <tr>
                      <td>{{ $detail->DateTime }}</td>
                      <td>{{ $detail->Location }}</td>
                      <td>{{ $detail->Status }}</td>
                      <td>{{ $detail->Detail }}</td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>

              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span style="color:red;">{{ $tracking[0]->message }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}">
                        <button class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>

        @endif
     
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