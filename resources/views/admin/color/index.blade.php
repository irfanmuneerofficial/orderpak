@extends('admin.layouts.master')
@section('page-title')
Colors
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Colors</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Colors </li>
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
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" data-toggle="modal" href='#modal-id'>Create Colors</a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary">
                          <form action="/admin/colors/" method="post" >
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="title">Title</label>
                                <span id="error" class="alert-danger"></span>
                                <input id="title" name="title" class="form-control" type="text" placeholder="Title" class="required validate">
                              </div>
                              <div class="form-group">
                                <label for="title">Color code</label>
                                <input id="color_code" name="color_code" class="form-control" type="text" placeholder="Color code" class="">
                              </div>
                              <!--<div class="form-group">-->
                              <!--  <label for="title">Slug</label>-->
                              <!--  <input id="slug" name="slug" class="form-control" readonly="" type="text" placeholder="Slug" class="required validate" required="">-->
                              <!--</div>                                                   -->
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
                    <th>Color code</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($colors as $brand)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$brand->title}}</td>
                      <td>{{$brand->slug}}</td>
                      <td>{{$brand->color_code}} <p style="background-color:{{$brand->color_code}}">&nbsp;</p></td>
                      <td>

                      <a class="btn btn-default btn-sm" data-toggle="modal" href='#modal-{{$brand->id}}'><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{$brand->id}}" ><i class="far fa-trash-alt"></i></a>

                        <div class="modal fade" id="modal-{{$brand->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit color</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form  method="post" action="/admin/colors/{{$brand->id}}/" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                  <div class="form-group">
                                    <label for="title">Title</label>
                                    <span id="editerror-{{$brand->id}}" class="alert-danger"></span>

                                    <input id="{{$brand->id}}" onchange="myFunction()" name="title" class="form-control edittitle edittitle-{{$brand->id}}" value="{{$brand->title}}" type="text" placeholder="Title" class="required validate">
                                  </div>
                                  <div class="form-group">
                                    <label for="title">Color code</label>

                                    <input id="" name="color_code" class="form-control edittitle edittitle-{{$brand->id}}" value="{{$brand->color_code}}"  type="text" placeholder="Color code" class="">
                                  </div>
                                  <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input id="editslug-{{$brand->id}}" name="slug" class="form-control editslug" readonly="" type="text" placeholder="Slug" class="required validate" value="{{$brand->slug}}" required="">
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <th>Color code</th>
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
// Slug
  $('#title').change(function(e) {
    $.get('{{ url('/admin/color_slug') }}',
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

  $( ".edittitle" ).change(function() {
    var val = $(this).val();
    var id = $(this).attr('id');

    $.get('{{ url('/admin/color_slug') }}',
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

//DeleteCompany
 $('body').on('click', '#deleteCompany', function (event) {
  // alert('sda');
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
            url: '/admin/colors/'+id+'/',
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
</script>

</script>
@endpush
