@extends('admin.layouts.master')
@section('page-title')
Brands
@endsection
@section('mainContent')
<div class="content-wrapper">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Sorry!</strong> There were more problems.<br><br>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Brand</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand </li>
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
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" data-toggle="modal" href='#modal-id'>Create Brand</a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary">
                          <form id="categorycreateform" method="post" enctype="multipart/form-data">
                            {{-- {!! csrf_field() !!} --}}
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="title">Title</label>
                                <span id="error" class="alert-danger"></span>
                                <input id="title" name="title" class="form-control" type="text" placeholder="Title" class="required validate">
                              </div>
                              <div class="form-group">
                                <label for="title">Slug</label>
                                <input id="slug" name="slug" class="form-control" readonly="" type="text" placeholder="Slug" class="required validate" required="">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Brand Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="form-control" id="brand_img" name="brand_img">
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
                              </div>  
                              <div class="form-group">
                                <label for="link">Link</label>
                                <input id="link" name="link" class="form-control" type="text" placeholder="Link" class="required validate">
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="modal-footer"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand Image</th>
                    <th>Link</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($brands as $brand)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$brand->title}}</td>
                      <td>
                        @if($brand->brand_img)
                        <img src="/uploads/brand/{{$brand->brand_img}}" width="100" alt="">
                        @else
                        Image Not Found
                        @endif
                      </td>
                      <td>{{$brand->link}}</td>
                        {{-- <a href="{{$brand->id}}" data-hover="tooltip" data-placement="top" data-target="#modal-edit-customers{{ $brand->id }}" data-toggle="modal" id="modal-edit" title="Edit"></a> --}}
                      <td>

                      <a class="btn btn-default btn-sm" data-toggle="modal" href='#modal-{{$brand->id}}'><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{$brand->id}}" ><i class="far fa-trash-alt"></i></a>
                        <div class="modal fade" id="modal-{{$brand->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit contact</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form  method="post" action="/admin/brand/{{$brand->id}}/" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                  <div class="form-group">
                                    <label for="title">Title</label>
                                    <span id="editerror-{{$brand->id}}" class="alert-danger"></span>

                                    <input id="{{$brand->id}}" onchange="myFunction()" name="title" class="form-control edittitle edittitle-{{$brand->id}}" value="{{$brand->title}}" type="text" placeholder="Title" class="required validate">

                                  </div>
                                  <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input id="editslug-{{$brand->id}}" name="slug" class="form-control editslug" readonly="" type="text" placeholder="Slug" class="required validate" value="{{$brand->slug}}" required="">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Brand Image</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="form-control" id="editbrand_img" name="brand_img">
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                      </div>
                                    </div>
                                  </div>    
                                  <div class="form-group">
                                    <label for="link">Link</label>
                                    <input id="link" value="{{$brand->link}}" name="link" class="form-control" type="text" placeholder="Link" class="required validate">
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand Image</th>
                    <th>Link</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection  

@push('ajax_crud')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    get_company_data()
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function get_company_data() {
      $.ajax({
            url: '/admin/brandd',
            type:'GET',
          data: { }
      }).done(function(data){
    // alert(data.data);
        table_data_row(data.data)

      });
    }

  //Sliders table row
  function table_data_row(data) {

    var rows = '';
    var id ='1';
    $.each( data, function( key, value ) {

        
      rows = rows + '<tr>';
      rows = rows + '<td>'+id++ +'</td>';
      rows = rows + '<td>'+value.title+'</td>';
      rows = rows + '<td><img src="/uploads/brand/'+ value.brand_img+'" width="100"></td>';
      rows = rows + '<td data-id="'+value.id+'">';
      rows = rows + '<a class="btn btn-sm" id="editSliders" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-idd"><i class="far fa-edit"></i></a> ';
      rows = rows + '<a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="'+value.id+'" ><i class="far fa-trash-alt"></i></a> ';
      rows = rows + '</td>';
      rows = rows + '</tr>';
    });
    $("#tbody").html(rows);
  }

  //Save data into database
  $('#categorycreateform').submit(function(event) {
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        event.preventDefault()
        var formData = new FormData(this);

        $.ajax
        ({
            url: '<?php echo url('/admin/brand') . '/';?>',
            type: 'POST',              
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(result)
            {
              swal("Brand Insert!", "You clicked the button!", "success");  
              $('#comment').trigger("reset");
              jQuery.noConflict();
              $('#modal-id').modal('hide');
              location.reload();
            },
            error: function (data) {
                console.log('Error......');
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

        $.ajax(
          {
            url: '/admin/brand/'+id,
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
<script type="text/javascript">
  $(document).ready(function () {
// Slug
  $('#title').change(function(e) {
    $.get('{{ url('/admin/brand_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        if(data.error){
          $('#error').text(data.error);
          // $('#slug').val(data.error);
          $('#title').val(null);
          $('#slug').val(null);
        }
        else{
          $('#slug').val(data.slug);
        }
      }
    );
  });

  // edit
 $( ".edittitle" ).change(function() {
    var val = $(this).val();
    var id = $(this).attr('id');

    $.get('{{ url('/admin/brand_slug') }}', 
      { 'title': val }, 
      function( data ) 
      {
        if(data.error)
        {
          $('#editerror-'+id).text(data.error);
          $('.edittitle-'+id).val(null);
          $('#editslug-'+id).val(null);
        }
        else{
        // alert(data.slug);
          $('#editslug-'+id).val(data.slug);
        }
      }
    );

  });
  });

</script>

</script>
@endpush