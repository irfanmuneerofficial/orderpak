@extends('admin.layouts.master')
@section('page-title')
shipping
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">shipping</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">shipping </li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-success" id="createNewCompany" href='{{route('shipping.create')}}'>Create Shipping Price</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="shipping_list" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Main Category</th>
                    <th>Main Category Price</th>
                    <th>Parent Category</th>
                    <th>Parent Category Price</th>
                    <th>Child Category</th>
                    <th>Child Category Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
                    @foreach($shipping_prices as $row)
                    <tr>
                     
                      <td>{{ ($row->category) ? $row->category->title : '' }}</td>
                     
                      @if($row->main_price == null)
                      <td>0</td>
                      @else
                      <td>{{$row->main_price}}</td>
                      @endif
                   
                      <td>{{ ($row->subcategory) ? $row->subcategory->title : '' }}</td>
                     
                      @if($row->parent_price == null)
                      <td>0</td>
                      @else
                      <td>{{$row->parent_price}}</td>
                      @endif
                    
                      <td>{{ ($row->childcategory) ? $row->childcategory->title : '' }}</td>
                      
                      @if($row->child_price == null)
                      <td>0</td>
                      @else
                      <td>{{$row->child_price}}</td>
                      @endif
                      <td class="project-actions text-right">
                        <a class="badge badge-info btn-sm" href="/admin/shipping/{{ $row->id }}/edit">
                          <i class="fas fa-pen">
                          </i>
                          Edit
                        </a>
                      <form id="formDelete" name="formDelete" method="post" action="/admin/shipping/{{ $row->id }}/">
                        @csrf
                        {{ @method_field('delete') }}
                        <button type="submit" class="badge badge-danger btn-sm">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                        </button>
                      </form>
                     </td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Main Category</th>
                    <th>Main Category Price</th>
                    <th>Parent Category</th>
                    <th>Parent Category Price</th>
                    <th>Child Category</th>
                    <th>Child Category Price</th>
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
            url: '/admin/shipping_category/',
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
      url: '/admin/shipping/',
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
   
//     $.get('/admin/shipping/'+ id+'/edit', function (data) {
//          alert(data);
//          $('#userCrudModall').html("Edit company");
//          $('#submitt').val("Edit shipping");
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
      url: '/admin/shipping/'+id+'/',
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
            url: '/admin/shipping/'+id+'/',
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