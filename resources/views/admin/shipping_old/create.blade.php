@extends('admin.layouts.master')
@section('page-title')
Add Shipping
@endsection
@section('mainContent')
<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Shipping</h1>
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
  <form name="form-example-1" id="form-example-1" action="{{route('shipping.store')}}/" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Shipping</h3>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Category</label>
                    <select name="main_id" id="main_id" onchange="parentcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Category</option>
                      @foreach($categories as $data)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endforeach
                    </select>
                    <div class="form-group">
                      <br>
	                    <label for="exampleInputEmail1">Category Shipping Price</label>
	                    <input type="text" id="main_price" required="" name="main_price" class="form-control" id="exampleInputEmail1" placeholder="Example: 200">
	                  </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="parentselect" style="display:none;">
                    <label>Select Sub Category</label>
                    <select name="parent_id" id="select2" onchange="childcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Sub Category</option>
                    </select>
                    <div class="form-group">
                      <br>
	                    <label for="exampleInputEmail1">Sub Category Shipping Price</label>
	                    <input type="text" id="parent_price" name="parent_price" class="form-control" id="exampleInputEmail1" placeholder="Example: 200">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect" style="display:none;">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4"  style="width: 100%;">
                      <option value="">Select Child Category</option>
                    </select>
                    <div class="form-group">
                      <br>
	                    <label for="exampleInputEmail1">Child Category shipping Rate</label>
	                    <input type="text" id="child_price" name="child_price" class="form-control" id="exampleInputEmail1" placeholder="Example: 200">
                    </div>
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
    <a href="/admin/shipping" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-success float-right">Add Shipping</button>
  </div>
</div>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

{{-- Show sub Categories --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
function parentcategory(quantidade){
  // alert(quantidade);
  $("#childselect").hide();
  $.ajax({
    method: "GET",
    url: '/admin/getparentcategory/',
    data: {
        id: quantidade,
    },
    success: function (response) 
    {
      if(response=='')
      {
        $("#parentselect").hide();
        $('#select2').hide();
        $("#childselect").hide();
        $('#select3').hide();
      }
      else
      {
        $("#parentselect").show();
        var myselect = $('<select>');
        myselect.append($('<option value="">Select Sub Category</option>'));
        $.each(response, function(index, key) {
          // alert(key['title'])
          myselect.append( $('<option></option>').val(key['id']).html(key['title']) );
        });
        $('#select2').empty().append(myselect.html());
      }
    },                               
  }); 
}
function childcategory(quantidade){
  $.ajax({
    method: "GET",
    url: '/vendor/getchildcategory/',
    data: {
        id: quantidade,
    },
    success: function (response) 
    {
      if(response=='')
      {
        $("#childselect").hide();
        $('#select3').hide();
      }
      else
      {
        $("#childselect").show();
        var myselect = $('<select>');
        myselect.append($('<option value="">Select Child Category</option>'));
        $.each(response, function(index, key) {
          myselect.append( $('<option></option>').val(key['id']).html(key['title']) );
        });
        $('#select3').empty().append(myselect.html());
      }
    },                               
  }); 
}
</script>
@endsection