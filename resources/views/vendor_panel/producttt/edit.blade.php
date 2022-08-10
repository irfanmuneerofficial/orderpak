@extends('vendor_panel.layouts.master')
@section('title')
Edit Product
@endsection
@section('mainContent')
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
  <form name="formEdit" id="formEdit" action="/vendor/product/{{$product->id}}/" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Product</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Product Title</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" required>
            </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" onchange="parentcategoryy(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="{{$product->category_id}}">{{$product->categoryname->title}}</option>
                      @foreach($category as $data)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="parentselect">
                    <label>Select Sub Category</label>
                    <select name="parent_id" id="select2" onchange="childcategoryy(this.value)" class="form-control select2bs4" style="width: 100%;">
                      @if($product->parent_id != null)
                      <option value="{{$product->parent_id}}">{{$product->parentcategory->title}}</option>
                      @endif
                      @foreach($parentcategory as $data)
                      @if($product->parent_id == $data->id)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4" style="width: 100%;">
                      @if($product->child_id != null)
                      <option value="{{$product->child_id}}">{{$product->childcategory->title}}</option>
                      @endif
                      @foreach($childcategory as $data)
                      @if($product->child_id == $data->id)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Brand</label>
                  <select name="brand_id" id="brand_id" class="form-control select2bs4" style="width: 100%;">
                    @if(!empty($product->brand->title))
                    <option value="{{$product->brand_id}}">{{$product->brand->title}}</option>
                    @endif
                    @foreach($brands as $brand)
                    @if($brand->id !=$product->category_id)
                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Condition</label>
                  <select name="condition" id="condition" class="form-control">
                    <option value="{{ $product->condition }}">{{ $product->condition }}</option>
                    <option value="new">New</option>
                    <option value="used">Used</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Size Chart Image</label>
                  <input type="file" name="size_chart" class="form-control m-input" autocomplete="off" >
                  <br>
                  @if(! $product->size_chart == null)
                  <img src="/uploads/product_images/{{ $product->size_chart }}" alt="{{ $product->size_chart }}" class="edit-image" style="width:100%">
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Model</label>
                  <input type="text" name="model" id="model" class="form-control" value="{{ $product->model }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">SKU</label>
                  <input type="text" name="productsku" id="product_sku" class="form-control" value="{{ $product->product_sku }}" required>
                  <input id="slug" name="product_sku" class="form-control" readonly="" type="text" value="{{ $product->product_sku }}" class="required validate" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Short Description</label>
              <div class="mb-3">
                <textarea class="textarea" name="short_description" id="short_description" rows="5" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! $product->short_description !!}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Product Description</label>
              <div class="mb-3">
                <textarea class="textarea" name="product_description" rows="5" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! $product->product_description !!}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Additional Details</label>
              <div class="mb-3">
                <textarea class="textarea" name="additional_details" rows="5" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->additional_details !!}</textarea>
              </div>
            </div>
            <div class="mt-3">
              <label for="size-check">Allow Product Sizes</label>
              <input name="size_check" type="checkbox" class="form-check" id="size-check" value="1" {{ !empty($product->size_check) ? "checked":"" }}>
              <br>
              <div {{-- class="{{ !empty($product->size_name) ? "":"showbox" }}" --}} id="size-display">
                <div class="product-size-details" id="size-section">
                  @if(!empty($product->size_check))
                  @foreach(json_decode($product->size_name) as $key => $value)
                  <div class="size-area">
                    <span class="remove color-remove float-right"><i class="fas fa-times"></i></span>
                    <div class="mb-3">
                      <label>
                        Size Name :<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>
                      </label>
                      <input type="text" name="size_name[]" id="size_name" class="form-control" placeholder="Size Name" value="{{ $value }}">
                    </div>
                  </div>
                  @endforeach
                  @else
                  <div class="product-size-details" id="size-section">
                    <div class="size-area">
                      <div class="mb-3">
                        <label>
                          Size Name :<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>
                        </label>
                        <input type="text" name="size_name[]" id="size_name" class="form-control" placeholder="Size Name">
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
                <div class="mt-3">
                  <a href="javascript:;" id="size-btn" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="mt-3">
              <label for="color-check">Allow Product Colors</label>
              <input name="color_check" type="checkbox" class="form-check" id="color-check" value="1" {{ !empty($product->color_check) ? "checked":"" }}>
              <div class="mt-3">
                <div {{-- class="{{ !empty($product->color_check) ? "":"showbox" }}" --}} id="color-display">
                  @if(!empty($product->color_check))
                  @foreach(json_decode($product->colors) as $key => $value)
                  <div class="select-input-color" {{-- id="color-section" --}}>
                    <div class="color-area">
                      <span class="remove color-remove float-right"><i class="fas fa-times"></i></span>
                      <div id="inputFormRow" class="form-group colorpicker-component cp">
                        <label>Select Color :<span>(Choose your color)</span></label>
                        <select name="colors[]" id="colors" class="form-control {{-- select2bs4 --}}" style="width: 100%;">
                          <option selected="selected" value="{{ $value }}">{{ $value }}</option>
                          @foreach($colors as $color)
                          <option value="{{ $color->slug }}">{{ $color->title }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div id="newRow"></div>
                    </div>
                  </div>
                  @endforeach
                  @else
                  <div class="select-input-color" {{-- id="color-section" --}}>
                    <div class="color-area">
                      <div id="inputFormRow" class="form-group colorpicker-component cp">
                        <label>Select Color :<span>(Choose your color)</span></label>
                        <select name="colors[]" id="colors" class="form-control {{-- select2bs4 --}}" style="width: 100%;">
                          <option>Please Select</option>
                          @foreach($colors as $color)
                          <option value="{{ $color->slug }}">{{ $color->title }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div id="newRow"></div>
                    </div>
                  </div>
                  @endif
                  <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Quantity</label>
                  <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Price</label>
                  <input type="number" name="price" id="price" class="form-control float-right" value="{{ $product->price }}" required>
                </div>
              </div>
            </div>
            <div class="mt-3">
              <label for="sale-check">Allow Product Sale</label>
              <input name="sale_status" type="checkbox" class="form-check" id="sale-check" value="1" {{ !empty($product->sale_status) ? "checked":"" }}>
              <br>
              <div class="row" id="sale-display">
                <div class="col-md-6">
                  <div id="saleprice" class="form-group">
                    <label>Sale Price</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rs.</span>
                      </div>
                      <input type="number" name="sale_price" class="form-control float-right" value="{{$product->sale_price}}" />
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div id="saledatetime" class="form-group sale_details_class">
                    <label>Date and Time Range</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                      </div>
                      <input type="text" name="sale_details" class="form-control float-right" value="{{$product->sale_details}}" />
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <div class="form-group">
                <label>Tags</label>
                <br/>
                <input id="tags" class="form-control" data-role="tagsinput" type="text" name="tags">
              </div>
            </div>
            <br>
            <h4 class="bold"> <lable for="inputName">Image Section</label></h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 1 (Main)</label>
                    <input type="file" name="image_1" class="form-control m-input" autocomplete="off" value="{{ $product->image_1 }}">
                    <br>
                    @if(! $product->image_1 == null)
                    <div class="mutli-img-edit">
                      <img src="/uploads/product_images/{{ $product->image_1 }}" alt="{{ $product->image_1 }}" class="edit-image" style="width:100%">
                    </div>
                    @else
                    <h3>No image found!</h3>
                    @endif
                  </div>
                  <br>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 2</label>
                    <input type="file" name="image_2" class="form-control m-input" autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_2 == null)
                  <div class="mutli-img-edit">
                    <img src="/uploads/product_images/{{ $product->image_2 }}" alt="{{ $product->image_2 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 3</label>
                    <input type="file" name="image_3" class="form-control m-input" autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_3 == null)
                  <div class="mutli-img-edit">
                    <img src="/uploads/product_images/{{ $product->image_3 }}" alt="{{ $product->image_3 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 4</label>
                    <input type="file" name="image_4" class="form-control m-input" autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_4 == null)
                  <div class="mutli-img-edit">
                    <img src="/uploads/product_images/{{ $product->image_4 }}" alt="{{ $product->image_4 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 5</label>
                    <input type="file" name="image_5" class="form-control m-input" autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_5 == null)
                  <div class="mutli-img-edit">
                    <img src="/uploads/product_images/{{ $product->image_5 }}" alt="{{ $product->image_5 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 6</label>
                    <input type="file" name="image_6" class="form-control m-input" autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_6 == null)
                  <div class="mutli-img-edit">
                    <img src="/uploads/product_images/{{ $product->image_6 }}" alt="{{ $product->image_6 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
            <h4> <lable for="inputName">Warrenty Details</label></h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Warrenty Type</label>
                  <input type="text" name="warrenty_type" id="warrenty_type" class="form-control" placeholder="Ex: Company, Local" value="{{ $product->warrenty_type }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Warrenty Period</label>
                  <input type="text" name="warrenty_period" id="warrenty_period" class="form-control" placeholder="Ex: 3 months, 1 year" value="{{ $product->warrenty_period }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Warrenty Policy</label>
              <textarea id="inputDescription" name="warrenty_policy" id="warrenty_policy" class="form-control" rows="4">{{ $product->warrenty_policy }}</textarea>
            </div>
            {{-- get hidden id --}}
            <input type="hidden" name="" id="check_id" value="{{$product->id}}">
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <a href="javascript:;" id="getData" >Get Data</a>
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-secondary">Cancel</a>
      <input type="submit" value="Create new Porject" class="btn btn-success float-right">
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- CHECK SIZE STATUS AJAX --}}

<script type="text/javascript">
  $(document).ready(function(){
    var checkId = $("#check_id").val();

    $.ajax({
      url: '/vendor/product/'+checkId+'/check_size/',
      type: 'get',
      dataType: 'json',
      success: function(response){
        // alert(response.size);
        if(response.size == 0)
          $("#size-display").hide();
      }
    });
  });
</script>

{{-- CHECK COLOR CHECK AJAX --}}

<script type="text/javascript">
  $(document).ready(function(){
    var checkId = $("#check_id").val();

    $.ajax({
      url: '/vendor/product/'+checkId+'/check_color/',
      type: 'get',
      dataType: 'json',
      success: function(response){
        // alert(response.size);
        if(response.color == 0)
          $("#color-display").hide();
      }
    });
  });
</script>

{{-- CHECK SALE STATUS AJAX --}}

<script type="text/javascript">
  $(document).ready(function(){
    var checkId = $("#check_id").val();

    $.ajax({
      url: '/vendor/product/'+checkId+'/check_sale/',
      type: 'get',
      dataType: 'json',
      success: function(response){
        // alert(response.size);
        if(response.sale == 0)
          $("#sale-display").hide();
      }
    });
  });
</script>



<script type="text/javascript">
$("#addRow").click(function () {
$.ajax({
type: 'get',
url: '/vendor/colors/',
dataType: 'json',
success: function( response ){
var html = '';
html += '<div id="inputFormRow" class="form-group colorpicker-component cp">';
  // html += '<div class="input-group-append">';
    // // <span class="remove size-remove float-right"><i class="fas fa-times"></i></span>
  // html += '</div>';
  html += '<span class="remove size-remove float-right" id="removeRow"><i class="fa fa-times"></i></span>';
  html += '<select name="colors[]" id="colors" class="form-control select2bs4" style="width: 100%;">';
    html += '<option value="">Select Color</option>';
    var len = 0;
    if(response['data'] != null){
    len = response['data'].length;
    }
    for(var i=0; i<len; i++)
    {
    var id = response['data'][i].id;
    var name = response['data'][i].title;
    html += "<option value='"+id+"'>"+name+"</option>";
    }
  html += '</select>';
  $('#newRow').append(html);
  }
  });
  // remove row
  $(document).on('click', '#removeRow', function () {
  $(this).closest('#inputFormRow').remove();
  });
  });
  </script>
  {{-- <script type="text/javascript">
  var saim = <?php $product->size_check ?>;
  alert(saim);
  // if($saim == 1){
  // }
  </script> --}}
  <script type="text/javascript">
  $(function() {
  $('input[name="sale_details"]').daterangepicker({
  // timePicker: true,
  autoUpdateInput: false,
  locale: {
  cancelLabel: 'Clear'
  }
  });
  $('input[name="sale_details"]').on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });
  $('input[name="sale_details"]').on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
  });
  });

  </script>
  {{-- Check Sku --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script>
  $('#product_sku').change(function(e) {
  $.get('{{ url('/vendor/product_sku') }}',
  {
  'title': $('#product_sku').val() },
  function( data ) {
  // alert(data);
  if(data.error){
  $('#error-sku').text(data.error);
  // $('#slug').val(data.error);
  $('#product_sku').val(null);
  $('#slug').val(null);
  }
  else{
  $('#error-sku').text(null);
  $('#slug').val(data.slug);
  }
  });
  });
  </script>
  {{-- Show sub Categories --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

{{-- <script type="text/javascript">
  function editGetParentCategory(quantidade){
    $.ajax({
      method: "GET",
      url: '/vendor/editgetparentcategory/',
      data: {
        id: quantidade,
      },
      success: function (response)
      {
        // alert(response);
      if(response=='')
      {
      $("#parentselect").hide();
      $('#select2').hide();
      $("#childselect").hide();
      $('#select3').hide();
      }
    });
  }


</script> --}}



      <script type="text/javascript">
      function parentcategoryy(quantidade){
      // alert(quantidade);
      $.ajax({
      method: "GET",
      url: '/vendor/getparentcategory/',
      data: {
      id: quantidade,
      },
      success: function (response)
      {
        // alert(response);
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
        myselect.append( $('<option></option>').val(key['id']).html(key['title']) );
        });
        $('#select2').empty().append(myselect.html());
        }
        },
        });
        }
        function childcategoryy(quantidade){
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
          // var myselect = '<option>Saad</option>';
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