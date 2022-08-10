@extends('admin.layouts.master')
@section('page-title')
  Edit Child Category
@endsection
@section('mainContent')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Child Category</h1>
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
      <form name="form-example-1" id="form-example-1" action="/admin/childcategory/{{$subcategory->id}}/" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit SubCategory</h3>
              </div>
              <div class="card-body">

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="title">Title</label>
                      <span id="editerror-{{$subcategory->id}}" class="alert-danger"></span>
                      <input id="{{$subcategory->id}}" onchange="myFunction()" name="title" class="form-control edittitle edittitle-{{$subcategory->id}}" value="{{$subcategory->title}}" type="text" placeholder="Title" class="required validate" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputFile">Category Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="form-control" id="editcategory_img" name="category_img">
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <textarea name="head" id="head" rows="30" cols="5"   class="show"  ></textarea>
                    </div>


                     <div class="form-group">
                      <label for="title">Meta Title</label>
                      <input id="meta_title"  name="meta_title" class="form-control" value="{{$subcategory->meta_title}}" type="text"/>
                      </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="title">Slug</label>
                      <input id="editslug-{{$subcategory->id}}" name="slug" class="form-control editslug" readonly="" type="text" placeholder="Slug" class="required validate" value="{{$subcategory->slug}}" required="">
                    </div>


                    <div class="form-group">
                      <label for="exampleInputFile">Main Category</label>
                      <div class="input-group">
                        <select name="parent_id" id="parent_id" class="form-control" required="required">
                          <option value="{{$subcategory->parent_id}}">{{$subcategory->parent_id}}</option>
                          @foreach($categories as $data)
                            <option value="{{$data->id}}"> {{$data->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                 
                    <div class="form-group">
                      <textarea name="description" id="description" rows="30" cols="5"  class="hide"  ></textarea>
                    </div>

                   
                    <div class="form-group">
                       <label for="exampleInputFile">Meta Description</label>
                      <textarea name="meta_description" id="meta_description" rows="3" cols="2" class="form-control">{{$subcategory->meta_description}}</textarea>
                    </div>
  
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="exampleInputFile">Script Text</label>
                      <textarea name="script_text" id="script_text" rows="10" class="form-control">{{$subcategory->script_text}}</textarea>
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
            <a href="/admin/category" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success float-right">Edit Child Category</button>
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
    $('#title').change(function(e) {
      $.get('{{ url('/admin/main_category_slug') }}',
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
    $(document).ready(function () {


      var id = '<?php echo $subcategory->id; ?>';

      $.ajax({
        url: '/admin/view_childcategory/?id='+id+'/',
        type: 'GET',
        format: 'json',
        error: function(error) {
          console.log(error);
          // var message = error.responseJSON.error.messages;
        },
        success: function(response) {
          console.log(response);
          var  record = response.response.data;
          var show = response.response.data.showtext;
          var hide = response.response.data.hidetext;
          $('.show').summernote('code', show);
          $('.hide').summernote('code', hide);
          $('.note-editable').height(300);

        },

        timeout: 10000 // sets timeout to 3 seconds
      });

      $( ".edittitle" ).change(function() {
        var val = $(this).val();
        var id = $(this).attr('id');

        $.get('{{ url('/admin/main_category_slug') }}',
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
@endsection