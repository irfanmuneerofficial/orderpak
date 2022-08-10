@extends('admin.layouts.master')
@section('page-title')
Child Category
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
            <h1 class="m-0 text-dark">Child Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Child Categories </li>
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
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" data-toggle="modal" href='#modal-id'>Create Sub Category</a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="card card-primary">
                          <form action="/admin/childcategory/" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="title">Title</label>
                                <span id="error" class="alert-danger"></span>
                                <input id="title" name="title" class="form-control" type="text" placeholder="Title" class="required validate" required="">
                              </div>

                              <div class="form-group">
                                <label for="title">Slug</label>
                                <input id="slug" name="slug" class="form-control" readonly="" type="text" placeholder="Slug" class="required validate" required="">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputFile">Sub Category</label>
                                <div class="input-group">
                                  <select name="parent_id" id="category_id" class="form-control" required="required">
                                    <option value="">Select Sub Category</option>
                                    @foreach($parentcategory as $data)
                                    <option value="{{$data->id}}"> {{$data->title}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="exampleInputFile">Category Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="form-control" id="category_img" name="image" required="">
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
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
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Sub Catergory</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($childcategory as $category)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$category->title}}</td>
                      <td>{{$category->slug}}</td>
                      <td>{{$category->title}}</td>
                      <td><img src="/uploads/category/{{$category->image}}" width="100" alt=""></td>
                      <td data-id="{{$category->id}}">
                      <a class="btn btn-default btn-sm" data-toggle="modal" href='#modal-{{$category->id}}'><i class="fa fa-edit"></i></a>
                      <form method="post" action="/admin/childcategory/{{ $category->id }}/">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-sm py-0" style="font-size: 0.8em;"> <i class="far fa-trash-alt"></i></button>
                      </form>
                        <div class="modal fade" id="modal-{{$category->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit contact</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form  method="post" action="/admin/childcategory/{{$category->id}}/" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                  <div class="form-group">
                                    <label for="title">Title</label>
                                    <span id="editerror-{{$category->id}}" class="alert-danger"></span>

                                    <input id="{{$category->id}}" onchange="myFunction()" name="title" class="form-control edittitle edittitle-{{$category->id}}" value="{{$category->title}}" type="text" placeholder="Title" class="required validate">
                                  </div>
                                  <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input id="editslug-{{$category->id}}" name="slug" class="form-control editslug" readonly="" type="text" placeholder="Slug" class="required validate" value="{{$category->slug}}" required="">
                                  </div>  
                                  <div class="form-group">
                                    <label for="exampleInputFile">Main Category</label>
                                    <div class="input-group">
                                      <select name="parent_id" id="category_id" class="form-control" required="required">
                                        <option value="{{$category->parent_id}}">{{$category->parent_id}}</option>
                                        @foreach($parentcategory as $data)
                                        <option value="{{$data->id}}"> {{$data->title}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Category Image</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="form-control" id="editcategory_img" name="image">
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                      </div>
                                    </div>
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
                    <th>Slug</th>
                    <th>Sub Catergory</th>
                    <th>Image</th>
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
<script>
  $('#title').change(function(e) {
    $.get('{{ url('/admin/check_child_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        if(data.error){
          $('#error').text(data.error);
          // $('#slug').val(data.error);
          $('#title').val(null);
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

    $.get('{{ url('/admin/check_child_slug') }}', 
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
</script>

@endpush