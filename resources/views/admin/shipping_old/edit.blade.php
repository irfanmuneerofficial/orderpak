@extends('admin.layouts.master')
@section('page-title')
Add shipping
@endsection
@section('mainContent')
<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">shipping</h1>
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
  <form name="form-example-1" id="form-example-1" action="/admin/shipping/{{$shipping->id}}/" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit shipping</h3>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Category</label>
                    <select name="main_id" id="main_id" onchange="parentcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <!--<option value="">Select Category</option>-->
                      <option value="{{$shipping->main_id}}"> {{$shipping->category->title}}</option>
                      @foreach($categories as $data)
                      @if($data->id == $shipping->category_id)
                        <option value="{{$data->id}}"> {{$data->title}}</option>
                      @else
                      
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="form-group">
	                    <label for="exampleInputEmail1">Category shipping Rate</label>
	                    <input type="text" id="main_price" name="main_price" class="form-control" value="{{$shipping->main_price}}" id="exampleInputEmail1" placeholder="Example: 200">
	                  </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="parentselect" style="($shipping->parent_id) ? display:block;  : display:none;">
                    <label>Select Sub Category</label>
                    <select name="parent_id" id="select2" onchange="childcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                        @if($shipping->parent_id != null)
                          <option value="{{$shipping->parent_id}}">{{$shipping->subcategory->title}}</option>
                        @endif
                        @foreach($subcategories as $data)
                        @if($shipping->main_id == $data->main_id)
                          <option value="{{$data->id}}"> {{$data->title}}</option>
                        @endif
                        @endforeach
                    </select>
                    <div class="form-group">
	                    <label for="exampleInputEmail1">Sub Category shipping Rate</label>
	                    <input type="text" id="parent_price" name="parent_price" class="form-control" value="{{$shipping->parent_price}}" id="exampleInputEmail1" placeholder="Example: 200">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect" style="($shipping->child_id) ? display:block;  : display:none;">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4"  style="width: 100%;">
                      @if($shipping->child_id != null)
                        <option value="{{$shipping->child_id}}">{{$shipping->childcategory->title}}</option>
                      @endif
                      @foreach($childcategory as $data)
                      @if($shipping->parent_id == $data->parent_id)
                        <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="form-group">
	                    <label for="exampleInputEmail1">Child Category shipping Rate</label>
	                    <input type="text" id="child_price" name="child_price" value="{{$shipping->child_price}}" class="form-control" id="exampleInputEmail1" placeholder="Example: 200">
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
    <button type="submit" class="btn btn-success float-right">Edit shipping</button>
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
    url: '/vendor/getparentcategory/',
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
        $('#parent_rate').val('');
        $('#child_rate').val('');
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
        $('#parent_rate').val('');
        $('#child_rate').val('');
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
        $('#child_rate').val('');
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
        $('#child_rate').val('');
      }
    },                               
  }); 
}
</script>
@endsection