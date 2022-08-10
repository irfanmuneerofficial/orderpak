@extends('admin.layouts.master')
@section('page-title')
  Add Sub Category
@endsection
@section('mainContent')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category</h1>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

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
      <form name="form-example-1" id="form-example-1" action="{{route('childcategory.store')}}/" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Sub Category</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="title">Title</label>
                      <span id="error" class="alert-danger"></span>
                      <input id="title" name="title" class="form-control" type="text" placeholder="Title" class="required validate" required>
                    </div>



                    <div class="form-group">
                      <label for="exampleInputFile">Sub Category</label>
                      <div class="input-group">
                        <select name="parent_id" id="parent_id" class="form-control" required="required">
                          <option value="">Select Sub Category</option>
                          @foreach($category as $data)
                            <option value="{{$data->id}}"> {{$data->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <textarea name="head" id="head"  rows="30" cols="5"    class="summernote"  ></textarea>
                    </div>


                     <div class="form-group">
                      <label for="title">Meta Title</label>
                      <input id="meta_title" name="meta_title" class="form-control" type="text"/>
                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="title">Slug</label>
                      <input id="slug" name="slug" class="form-control" readonly="" type="text" placeholder="Slug" class="required validate" required="">
                    </div>


                    <div class="form-group">
                      <label for="exampleInputFile">Category Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="form-control" id="category_img" name="category_img">
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <textarea name="description" id="description" rows="30" cols="5"  class="summernote"  ></textarea>
                    </div>

                     <div class="form-group">
                       <label for="exampleInputFile">Meta Description</label>
                      <textarea name="meta_description" id="meta_description" rows="3" cols="2" class="form-control"></textarea>
                      </div>

                  </div>

                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="row">
          <div class="col-12">
            <a href="/admin/subcategory" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success float-right">Add Child Category</button>
          </div>
        </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  {{-- Show sub Categories --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script type="text/javascript">

    $('.summernote').summernote({
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });

    $('.note-editable').height(200);

    $('#title').change(function(e) {
      $.get('{{ url('/admin/check_parent_slug') }}',
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

      $.get('{{ url('/admin/check_parent_slug') }}',
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
@endsection