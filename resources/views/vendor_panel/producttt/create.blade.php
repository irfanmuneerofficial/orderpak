@extends('vendor_panel.layouts.master')
@section('title')
Add Product
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
  <form name="form-example-1" id="form-example-1" action="{{route('product.store')}}/" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Product</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Product Title</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            {{-- <div class="col-md-6"> --}}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" onchange="parentcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Category</option>
                      @foreach($category as $data)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="parentselect" style="display:none;">
                    <label>Select Sub Category</label>
                    <select name="parent_id" id="select2" onchange="childcategory(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Sub Category</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect" style="display:none;">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Child Category</option>
                    </select>
                  </div>
                </div>
                
              </div>
              {{-- <select id="select2" ></select> --}}
            {{-- </div> --}}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Brand</label>
                  <select name="brand_id" id="brand_id" class="form-control select2bs4" style="width: 100%;">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Condition</label>
                  <select name="condition" id="condition" class="form-control">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Size Chart Image</label>
                  <input type="file" name="size_chart" class="form-control m-input" autocomplete="off" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Model</label>
                  <input type="text" name="model" id="model" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">SKU</label>
                  <span id="error-sku" class="alert-danger"></span>
                  <input type="text" name="productsku" id="product_sku" class="form-control" required>
                  <input id="slug" name="product_sku" class="form-control" readonly="" type="text" placeholder="sku" class="required validate" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Short Description</label>
              <div class="mb-3">
                <textarea class="textarea" name="short_description" id="short_description"  placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Product Description</label>
              <div class="mb-3">
                <textarea class="textarea" name="product_description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Additional Details</label>
              {{-- <input type="text" id="inputName" class="form-control"> --}}
              <div class="mb-3">
                <textarea class="textarea" name="additional_details" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>
            <div class="form-group">
          </div>
          <div class="mt-3">
            <label for="size-check">Allow Product Sizes</label>
            <input name="size_check" type="checkbox" class="form-check" id="size-check" value="1">
            <br>
            <div class="showbox" id="size-display">
              <div class="product-size-details" id="size-section">
                <div class="size-area">
                  {{-- <span class="remove size-remove float-right"><i class="fas fa-times"></i></span> --}}
                  <div class="mb-3">
                    {{-- <div class="row"> --}}
                      {{-- <div class="col-6"> --}}
                        <label>
                          Size Name :<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>
                        </label>
                        <input type="text" name="size_name[]" id="size_name" class="form-control" placeholder="Size Name">
                      {{-- </div> --}}
                      {{-- <div class="col-6">
                        <label>
                          Size Qty :<span>(Define quantity)</span>
                        </label>
                        <input type="number" name="size_qty[]" id="size_qty" class="form-control" placeholder="Size Qty" min="1">
                      </div> --}}
                    {{-- </div> --}}
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <a href="javascript:;" id="size-btn" class="btn btn-success"><i class="fas fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="mt-3">
            <label for="color-check">Allow Product Colors</label>
            <input name="color_check" type="checkbox" class="form-check" id="color-check" value="1">
            <div class="mt-3">
              <div class="showbox" id="color-display">
                <label>Select Color :<span>(Choose your color)</span></label>
                <div class="select-input-color" id="color-section">
                  <div class="color-area">
                    <div id="inputFormRow" class="form-group colorpicker-component cp">
                      <select name="colors[]" id="colors" class="form-control select2bs4" style="width: 100%;">
                        <option value="">Select Color</option>
                        @foreach($colors as $row)
                        <option value="{{$row->slug}}">{{$row->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div id="newRow"></div>
                  </div>
                </div>
                <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
              </div>
            </div>
            {{-- <div class="col-md-2">
              <div class="form-group">
                <label>Sale Status</label>
                <input type="text" name="sale_status" id="sale_off_button" class="btn btn-danger form-control off_saim" value="OFF" readonly style="background-color: #C82333;">
                <input type="text" name="sale_status" id="sale_on_button" class="btn btn-info form-control on_saim" value="ON" readonly style="background-color: #138496;">
              </div>
            </div>
            <div class="col-md-3">
              <div id="saleprice" class="form-group">
                <label>Sale Price</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rs.</span>
                  </div>
                  <input type="text" name="sale_price" class="form-control float-right"/>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <div class="col-md-3">
              <div id="saledatetime" class="form-group">
                <label>Date and Time Range</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                  </div>
                  <input type="text" name="sale_details" class="form-control float-right" value="" autofocus="off" />
                </div>
              </div>
            </div> --}}
          </div>
          <div class="mt-3">
            <label for="sale-check">Allow Product Sale</label>
            <input name="sale_status" type="checkbox" class="form-check" id="sale-check" value="1">
            <div class="row" id="sale-display">
              <div class="col-md-6">
                <div id="saleprice" class="form-group">
                  <label>Sale Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rs.</span>
                    </div>
                    <input type="number" name="sale_price" class="form-control float-right"/>
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
                    <input type="text" name="sale_details" class="form-control float-right" />
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
                  <input type="file" name="image_1" class="form-control m-input" autocomplete="off" required>
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
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 3</label>
                  <input type="file" name="image_3" class="form-control m-input" autocomplete="off">
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 4</label>
                  <input type="file" name="image_4" class="form-control m-input" autocomplete="off">
                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 5</label>
                  <input type="file" name="image_5" class="form-control m-input" autocomplete="off">
                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 6</label>
                  <input type="file" name="image_6" class="form-control m-input" autocomplete="off">
                </div>
                <br>
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group">
          <h4> <lable for="inputName">Warrenty Details</label></h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Warrenty Type</label>
              <input type="text" name="warrenty_type" id="warrenty_type" class="form-control" placeholder="Ex: Company, Local" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputName">Warrenty Period</label>
              <input type="text" name="warrenty_period" id="warrenty_period" class="form-control" placeholder="Ex: 3 months, 1 year" >
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputDescription">Warrenty Policy</label>
          <textarea id="inputDescription" name="warrenty_policy" id="warrenty_policy" class="form-control" rows="4"></textarea>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="#" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-success float-right">Create new Porject</button>
  </div>
</div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $("#size-display").hide();
  $("#color-display").hide();
  $("#sale-display").hide();
</script>

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

// $(".on_saim").hide();
// $("#saledatetime").hide();
// $("#saleprice").hide();

// $("#sale_off_button").click(function () {
//   $(".off_saim").hide();
//   $(".on_saim").show();
//   $("#saledatetime").show();
//   $("#saleprice").show();
// });

// $("#sale_on_button").click(function () {
//   $("#reservationtime").attr("id", "null");
//   $(".off_saim").show();
//   $(".on_saim").hide();
//   $("#saledatetime").hide();
//   $("#saleprice").hide();
// });

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