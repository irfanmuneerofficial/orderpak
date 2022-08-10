@extends('vendor_panel.layouts.master')
@section('title')
  Shop Create
@endsection
@section('mainContent')
    <!-- Content Header (Page header) -->
    <section class="content-header">
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
            <h1>Shop Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Shop Info</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="post" action="{{ url('/vendor/shop') }}/" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <!--<div class="form-group">-->
                  <!--  <label for="shop_name">Shop Name</label>-->
                  <!--  <span id="error" class="alert-danger"></span>-->
                  <!--  <input type="text" name="shop_name" class="form-control" id="shop_name" required="" placeholder="Enter Shop Name">-->
                  <!--</div>-->
                  <!--<div class="form-group">-->
                  <!--  <label for="shop_name">Slug</label>-->
                  <!--  <input type="text" readonly="" name="slug" class="form-control" id="slug" placeholder="Enter Shop Name">-->
                  <!--</div>-->
                  <div class="form-group">
                    <label for="shop_img">Shop Image</label>
                    <input type="file" name="shop_img" class="form-control" id="shop_img" required="">
                  </div>
                  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                  <script>
                    $('#shop_name').change(function(e) {
                      $.get('{{ url('/vendor/check_slug') }}', 
                        { 'shop_name': $(this).val() }, 
                        function( data ) {
                          if(data.error){
                            $('#error').text(data.error);
                            $('#shop_name').val(null);
                          }
                          else{
                            $('#slug').val(data.slug);
                          }
                        }
                      );
                    });
                  </script>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection