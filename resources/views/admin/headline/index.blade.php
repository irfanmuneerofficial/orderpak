@extends('admin.layouts.master')
@section('page-title')
Headline bar
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Headline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Headline </li>
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
              @if(!$headline)
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" data-toggle="modal" href='#modal-id'>Create Headline</a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary">
                          <form action="/admin/headline/" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="title">Text</label>
                                <span id="error" class="alert-danger"></span>
                                <textarea id="title" name="description" class="form-control" type="text" placeholder="Title" class="required validate"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="title">Logo</label>
                                <span id="error" class="alert-danger"></span>
                                <input id="logo" name="logo" class="form-control" type="file" placeholder="Logo" class="required validate">
                              </div>
                              <div class="form-group">
                                <label for="title">Background Color</label>
                                <span id="error" class="alert-danger"></span>
                                <input type="text" name="bgcolor" class="form-control my-colorpicker1">
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
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>Logo</th>
                    <th>Color</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @if($headline)
                    <tr>
                      <td>{{$id}}</td>
                      <td>{{$headline->description}}</td>
                      <td><img src="/uploads/admin/headline/{{$headline->logo}}" width="50" alt=""></td>
                      <td>{{$headline->bgcolor}}</td>
                      <td>                        
                      <a class="btn btn-default btn-sm" data-toggle="modal" href='#modal-{{$headline->id}}'><i class="fa fa-edit"></i></a>
                        {{-- <a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{$headline->id}}" ><i class="far fa-trash-alt"></i></a> --}}
                          <div class="modal fade" id="modal-{{$headline->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit contact</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <form  method="post" action="/admin/headline/{{$headline->id}}/" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="title">Test</label>
                                      <span id="editerror-{{$headline->id}}" class="alert-danger"></span>
                                      <textarea id="title" name="description" class="form-control" type="text" placeholder="Title" class="required validate">{{$headline->description}}</textarea>
                                    </div>     
                                    <div class="form-group">
                                      <label for="title">Logo</label>
                                      <span id="error" class="alert-danger"></span>
                                      <span id="success" class="alert-success"></span>
                                      <input id="logo" name="logo" class="form-control" type="file" placeholder="Logo" class="required validate">
                                      <span class="btn btn-danger" name="{{$headline->logo}}" id="closeimage1">Remove</span>                  
                                    </div>       
                                    <div class="form-group">
                                      <label for="title">Background Color</label>
                                      <span id="error" class="alert-danger"></span>
                                      <input value="{{$headline->bgcolor}}" type="text" name="bgcolor" class="form-control my-colorpicker1">
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
                        <form method="post" action="/admin/headline/{{ $headline->id }}/">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-sm py-0" style="font-size: 0.8em;"> <i class="far fa-trash-alt"></i></button>
                      </td>
                      
                    </tr>
                    @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>Logo</th>
                    <th>Background Color</th>
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
$(function () {
    $('.my-colorpicker1').colorpicker();

    $("#closeimage1").on("click", function (e) {
      
        event.preventDefault()
        var image_1 = $(this).attr('name');
        // alert(image_1);
        $.ajax({
          url: '/admin/headlne/remove_img/',
          type: "get",
          data: {
            logo: image_1,
            _token:'{{ csrf_token() }}'

          },
          // data: $('form').serialize(),
          dataType: 'json',
          success: function (data) {
        // alert(data.success);
            $('#success').text(data.success);
            // $("#closeimage1").hide();
            // $("#pimage1").hide();
          }
      });
    });
});

</script>
@endsection