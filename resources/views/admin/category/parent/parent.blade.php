@extends('admin.layouts.master')
@section('page-title')
Sub Category
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
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories </li>
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
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" href='{{route('subcategory.create')}}'>Create Sub Category</a>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Main Catergpry</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($categories as $category)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$category->title}}</td>
                      <td>{{$category->slug}}</td>
                      <td>{{--$category->categoryname->title--}}</td>
                      <td><img src="/uploads/category/{{$category->image}}" width="100" alt=""></td>
                      <td data-id="{{$category->id}}">
                      <a class="btn btn-default btn-sm" href="/admin/subcategory/{{ $category->id }}/edit"><i class="fa fa-edit"></i></a>
                      <form method="post" action="/admin/subcategory/{{ $category->id }}/">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-sm py-0" style="font-size: 0.8em;"> <i class="far fa-trash-alt"></i></button>
                      </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Main Catergpry</th>
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

@endpush
