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
  <form name="formEdit" id="form-example-1" action="{{ url('vendor/product', $product->id) }}/" method="post" enctype="multipart/form-data">
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
            <div class="form-group" id="titleErrDiv">
              <label for="inputName">Product Title</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}">
              <span class="text-danger" id="titleErr"></span>
            </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group" id="categoryErrDiv">
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" onchange="parentcategoryy(this.value)" class="form-control select2bs4" style="width: 100%;">
                      <option value="{{$product->category_id}}">{{$product->categoryname->title}}</option>
                      @foreach($category as $data)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="categoryErr"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="parentselect">
                    <label>Select Sub Category</label>
                    <select name="parent_id" id="select2" onchange="childcategoryy(this.value)" class="form-control select2bs4" style="width: 100%;">
                      @if($product->parent_id != null)
                      <option value="{{$product->parent_id}}">{{$product->parentcategory->title}}</option>
                      @endif
                      {{-- @foreach($parentcategory as $data)
                      @if($product->category_id == $data->main_id)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endif
                      @endforeach --}}
                      @foreach($category as $cat)
                      @if($cat->childCategories->count() > 0)
                        @foreach($cat->childCategories as $data)
                          @if($product->category_id == $data->parent_id)
                            <option value="{{$data->id}}"> {{$data->title}}</option>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    </select>
                    <span class="text-danger" id="parentCatErr"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4" style="width: 100%;">
                      @if($product->child_id != null)
                      <option value="{{$product->child_id}}">{{$product->childcategory->title}}</option>
                      @endif
                      @foreach($category as $cat)
                      @if($cat->childCategories->count() > 0)
                        @foreach($cat->childCategories as $childCat)
                          @if($childCat->childCategories->count() > 0)
                            @foreach($childCat->childCategories as $data)
                              @if($product->parent_id == $data->parent_id)
                                <option value="{{$data->id}}"> {{$data->title}}</option>
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="brandErrDiv">
                  <label>Brand</label>
                  <input type="text" name="brand_id" id="brand_id" class="form-control" value="{{$product->brand_id}}">
                  <span class="text-danger" id="brandErr"></span>
                </div>
              </div>
              <div class="col-md-6">
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
                <div class="form-group" id="skuErrDiv">
                  <label for="inputName">SKU </label>
                  <span id="error-sku" class="alert-danger"></span>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="sku-span"></span>
                      <input type="text" name="productsku" id="product_sku" class="form-control" value="{{ $product->product_sku }}" required="">
                      <input hidden="" name="vendor_id" value="{{Auth::guard('vendor')->user()->id}}">
                  </div>
                  <span class="text-danger" id="skuErr"></span>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="sku-slug-span"></span>
                      <input id="slug" name="product_sku" class="form-control" readonly="" type="text" placeholder="sku" value="{{ $product->product_sku }}" class="required validate" required="">
                  </div>
                  <span class="text-danger" id="slugErr"></span>
                  <div class="alert-danger" id="error-sku"></div>
                </div>
              </div>
            </div>
            <div class="form-group" id="short_descriptionErrDiv">
              <label for="inputDescription">Short Description</label>
              <span class="text-danger" id="short_descriptionErr"></span>
              <div class="mb-3">
                <textarea name="short_description" id="short_description" maxlength="1200" rows="5" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! $product->short_description !!}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Product Description</label>
              <div class="mb-3">
                <textarea id="textarea-product-desc-edit" name="product_description" rows="5" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! $product->product_description !!}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Additional Details</label>
              <div class="mb-3">
                <textarea id="textarea-product-addition-edit" name="additional_details" rows="5" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->additional_details !!}</textarea>
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
                      <span class="text-danger" id="sizenameErr"></span>
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
                      <span class="text-danger" id="sizenameErr"></span>
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
                          <option value="{{ $color->title }}">{{ $color->title }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="colorErr"></span>

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
                        <span class="text-danger" id="colorErr"></span>

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
              <div class="form-group" id="quantityErrDiv">
                <label for="inputName">Condition</label>
                <span class="text-danger" id="conditionErr"></span>
                <select name="condition" id="condition" class="form-control select2bs4" required style="width: 100%;">
                    @if($product->condition == '')
                    <option value="">Select Condition</option>
                    @else
                    <option value="{{$product->condition}}">{{$product->condition}}</option>
                    @endif
                    <!--<option value="">Select Condition</option>-->
                    <option value="Fresh">Fresh</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                    <option value="Refurbished">Refurbished</option>
                  </select>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group" id="quantityErrDiv">
                  <label for="inputName">Quantity</label>
                  <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="{{ $product->quantity }}" onwheel="this.blur()" required>
                  <span class="text-danger" id="quantityErr"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="priceErrDiv">
                  <label for="inputName">Price</label>
                  <input type="number" name="price" id="price" class="form-control" min="0" value="{{ $product->price }}" onwheel="this.blur()" required>
                  <span class="text-danger" id="priceErr"></span>                  
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
                    <span class="text-danger" id="salepriceErr"></span>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rs.</span>
                      </div>
                      <input type="number" name="sale_price" id="sale_price" class="form-control float-right" min="0" value="{{$product->sale_price}}" onwheel="this.blur()" />
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div id="saledatetime" class="form-group sale_details_class">
                    <label>Date and Time Range</label>
                    <span class="text-danger" id="saledetailErr"></span>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                      </div>
                      <input type="text" name="sale_details" id="sale_details" class="form-control float-right" value="{{$product->sale_details}}" />
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
                <input id="tags" class="form-control" data-role="tagsinput" type="text" value="@if(!empty(json_decode($product->tagss)))@foreach(json_decode($product->tagss) as $tagg){{$tagg}}@if(!$loop->last) , @endif @endforeach @else  @foreach($product->tags as $tag){{$tag->name}}@if(!$loop->last) , @endif @endforeach @endif" name="tags">
              </div>
            </div>
            <br>
            <h4 class="bold"> <lable for="inputName">Image Section</label></h4>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="image1ErrDiv">
                  <div id="inputFormRow2">
                    <label for="inputName">Image 1 (Main)</label>
                    <input type="file" name="image_1" id="image_1" value="{{$product->image_1}}" required class="form-control m-input"  autocomplete="off">
                    <input hidden name="image1" id="image1" value="{{$product->image_1}}" required class="form-control m-input"  autocomplete="off">
                    <span class="text-danger" id="image1Err"></span>                 
                    <br>
                    <input hidden="" id="req_image1" value="{{$product->image_1}}">
                    @if(! $product->image_1 == null)
                    <span class="btn btn-danger" id="closeimage1">Remove</span>
                    <br>
                    <div class="mutli-img-edit">
                      <img id="pimage1" src="/uploads/product_images/{{ $product->image_1 }}" alt="{{ $product->image_1 }}" class="edit-image" style="width:100%">
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
                    <input type="file" name="image_2" id="image_2" value="{{$product->image_2}}" class="form-control m-input" autocomplete="off">
                    <input hidden name="image2" id="image2" value="{{$product->image_2}}" required class="form-control m-input"  autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_2 == null)
                  <span class="btn btn-danger" id="closeimage2">Remove</span>
                  <br>
                  <div class="mutli-img-edit">
                    <img id="pimage2" src="/uploads/product_images/{{ $product->image_2 }}" alt="{{ $product->image_2 }}" class="edit-image" style="width:100%">
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
                    <input type="file" name="image_3" id="image_3" value="{{$product->image_3}}" class="form-control m-input" autocomplete="off">
                    <input hidden name="image3" id="image3" value="{{$product->image_3}}" required class="form-control m-input"  autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_3 == null)
                  <span class="btn btn-danger" id="closeimage3">Remove</span>
                  <br>
                  <div class="mutli-img-edit">
                    <img id="pimage3" src="/uploads/product_images/{{ $product->image_3 }}" alt="{{ $product->image_3 }}" class="edit-image" style="width:100%">
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
                    <input type="file" name="image_4" id="image_4" value="{{$product->image_4}}" class="form-control m-input" autocomplete="off">
                    <input hidden name="image4" id="image4" value="{{$product->image_4}}" required class="form-control m-input"  autocomplete="off">
                  </div>
                  <br>
                  @if(! $product->image_4 == null)
                  <span class="btn btn-danger" id="closeimage4">Remove</span>  
                  <br>
                  <div class="mutli-img-edit">
                    <img id="pimage4" src="/uploads/product_images/{{ $product->image_4 }}" alt="{{ $product->image_4 }}" class="edit-image" style="width:100%">
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
                    <input type="file" name="image_5" value="{{$product->image_5}}" class="form-control m-input" autocomplete="off">
                    <input hidden name="image5" id="image5" value="{{$product->image_5}}" required class="form-control m-input"  autocomplete="off">

                  </div>
                  <br>
                  @if(! $product->image_5 == null)
                  <span class="btn btn-danger" id="closeimage5">Remove</span> 
                  <br>     
                  <div class="mutli-img-edit">
                    <img id="pimage5" src="/uploads/product_images/{{ $product->image_5 }}" alt="{{ $product->image_5 }}" class="edit-image" style="width:100%">
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
                    <input type="file" name="image_6" value="{{$product->image_6}}" class="form-control m-input" autocomplete="off">
                    <input hidden name="image6" id="image6" value="{{$product->image_6}}" required class="form-control m-input"  autocomplete="off">

                  </div>
                  <br>
                  @if(! $product->image_6 == null)
                  <span class="btn btn-danger" id="closeimage6">Remove</span>
                  <br>
                  <div class="mutli-img-edit">
                    <img id="pimage6" src="/uploads/product_images/{{ $product->image_6 }}" alt="{{ $product->image_6 }}" class="edit-image" style="width:100%">
                  </div>
                  @else
                  <h3>No image found!</h3>
                  @endif
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
            <h4> <lable for="inputName">Warranty Details</label></h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Warranty Type</label>
                  <input type="text" name="warrenty_type" id="warrenty_type" class="form-control" placeholder="Ex: Company, Local" value="{{ $product->warrenty_type }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Warranty Period</label>
                  <input type="text" name="warrenty_period" id="warrenty_period" class="form-control" placeholder="Ex: 3 months, 1 year" value="{{ $product->warrenty_period }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDescription">Warranty Policy</label>
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
  <div class="row">
    <div class="col-12">
      <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
      <input type="submit" id="upload" value="Edit Product" class="btn btn-success float-right">
    </div>
  </div>
</form>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  // $("#closeimage1").hide();
  // $("#image_1").val("saim");  

  $("#image_1").change(function(){
    // alert("saim");
    $("#req_image1").val($(this).val());
    $("#closeimage1").show();
    });
    $("#closeimage1").on("click", function (e) {
      
        event.preventDefault()
            $('#image1').val('');
            $("#pimage1").hide();
            $('#req_image1').val('');
            $("#closeimage1").hide();

      //   var image_1 = $('#image_1').val();
      //   $.ajax({
      //     url: '/vendor/product/remove_image1/{{$product->id}}',
      //     type: "get",
      //     cache: false,
      //     enctype: 'multipart/form-data',
      //     data: {
      //       image_1: image_1,
      //       _token:'{{ csrf_token() }}'
      //     },
      //     // data: $('form').serialize(),
      //     dataType: 'json',
      //     success: function (data) {
      //       $('#image_1').val('');
      //       $("#closeimage1").hide();
      //       $("#pimage1").hide();
      //       $('#req_image1').val('');


      //     }
      // });
    });

  // $("#closeimage2").hide();
  $("#image_2").change(function(){
    $("#closeimage2").show();

    });
    $("#closeimage2").on("click", function (e) {

        event.preventDefault()
        $('#image2').val('');
            $("#closeimage2").hide();
            $("#pimage2").hide();
    });

  // $("#closeimage3").hide();
  $("#image_3").change(function(){
    $("#closeimage3").show();
    });
    $("#closeimage3").on("click", function (e) {
      event.preventDefault()
      $('#image3').val('');
            $("#closeimage3").hide();
            $("#pimage3").hide();
    });

  // $("#closeimage4").hide();
  $("#image_4").change(function(){
    $("#closeimage4").show();
    });
    $("#closeimage4").on("click", function (e) {
      event.preventDefault()
      $('#image4').val('');
      $("#closeimage4").hide();
      $("#pimage4").hide();
    });

  // $("#closeimage5").hide();
  $("#image_5").change(function(){
    $("#closeimage5").show();
    });
    $("#closeimage5").on("click", function (e) {
      event.preventDefault()
      $('#image5').val('');
      $("#closeimage5").hide();
      $("#pimage5").hide();
    });

  // $("#closeimage6").hide();
    $("#image_6").change(function(){
    $("#closeimage6").show();
    });
    $("#closeimage6").on("click", function (e) {
      event.preventDefault()
      $('#image6').val('');
      $("#closeimage6").hide();
      $("#pimage6").hide();
    });
</script>
<script type="text/javascript">

$(function () {
    $("#upload").bind("click", function (e) {
      e.preventDefault();

      var title = $('#title').val(); 
      var category = $('#category_id').val(); 
      var parentCat = $('#select2').val(); 
      var brand = $('#brand_id').val(); 
      var sku = $('#product_sku').val(); 
      var slug = $('#slug').val(); 
      var short_description = $('#short_description').val(); 
      var quantity = $('#quantity').val(); 
      var price = $('#price').val(); 
      var image1 = $("#req_image1").val(); 
      // alert(image1);

      if($('#size-check').prop('checked'))
      {
      // alert('checked'); 

        if(document.getElementById("size_name").value.length == 0)
        {

          // alert('sizecheck'); 
          $('html, body').animate({
              scrollTop: $("#size-section").offset().top
          }, 2000);
          $('#sizenameErr').text("Size Name is required!")
          return false;
          }
        else{
          $('#sizenameErr').hide()
        }
      }
      if(document.getElementById("condition").value.length == 0)
        {

          // alert('sizecheck'); 
          $('html, body').animate({
              scrollTop: $("#condition").offset().top
          }, 2000);
          $('#conditionErr').text("Condition is required!")
          return false;
          }
        else{
          $('#conditionErr').hide()
        }

      // Color Check
      if($('#color-check').prop('checked'))
      {
      // alert('checked'); 

        if(document.getElementById("colors").value.length == 0)
        {

          // alert('sizecheck'); 
          $('html, body').animate({
              scrollTop: $("#color-section").offset().top
          }, 2000);
          $('#colorErr').text("Color Name is required!")
          return false;
          }
        else{
          $('#colorErr').hide()
        }
      }

      // Sale
      // Color Check
      if($('#sale-check').prop('checked'))
      {
      // alert('checked'); 

        if(document.getElementById("sale_price").value.length == 0)
        {

          // alert('sizecheck'); 
          $('html, body').animate({
              scrollTop: $("#saleprice").offset().top
          }, 2000);
          $('#salepriceErr').text("Price is required!")
          return false;
          }
        else{
          $('#salepriceErr').hide()
        }

        if(document.getElementById("sale_details").value.length == 0)
        {

          // alert('sizecheck'); 
          $('html, body').animate({
              scrollTop: $("#saleprice").offset().top
          }, 2000);
          $('#saledetailErr').text("Detail is required!")
          return false;
          }
        else{
          $('#saledetailErr').hide()
        }
      }

      // Title
      if(!title){
        $('html, body').animate({
            scrollTop: $("#titleErrDiv").offset().top
        }, 2000);
        $('#titleErr').text("Title is required!")
        return false;
      }else{
        $('#titleErr').hide()
      }

      // category
      if(!category){
        $('html, body').animate({
            scrollTop: $("#categoryErrDiv").offset().top
        }, 2000);
        $('#categoryErr').text("Category is required!")
        return false;
      }else{
        $('#categoryErr').hide()
      }

      // sub category
      if(!parentCat){
        $('html, body').animate({
            scrollTop: $("#parentselect").offset().top
        }, 2000);
        $('#parentCatErr').text("Sub Category is required!")
        return false;
      }else{
        $('#parentCatErr').hide()
      }

      // Brand
      if(!brand){
        $('html, body').animate({
            scrollTop: $("#brandErrDiv").offset().top
        }, 2000);
        $('#brandErr').text("Brand is required!")
        return false;
      }else{
        $('#brandErr').hide()
      }

      // product sku
      if(!sku){
        $('html, body').animate({
            scrollTop: $("#skuErrDiv").offset().top
        }, 2000);
        $('#skuErr').text("sku is required!")
        return false;
      }else{
        $('#skuErr').hide()
      }

      // slug
      // if(!slug){
      //   $('html, body').animate({
      //       scrollTop: $("#slugErrDiv").offset().top
      //   }, 2000);
      //   $('#slugErr').text("slug is required!")
      //   return false;
      // }else{
      //   $('#slugErr').hide()
      // }

      // short description
      if(!short_description){
        $('html, body').animate({
            scrollTop: $("#short_descriptionErrDiv").offset().top
        }, 2000);
        $('#short_descriptionErr').text("Short Description is required!")
        return false;
      }else{
        $('#short_descriptionErr').hide()
      }

      // Quantity
      if(!quantity){
        $('html, body').animate({
            scrollTop: $("#quantityErrDiv").offset().top
        }, 2000);
        $('#quantityErr').text("quantity is required!")
        return false;
      }else{
        $('#quantityErr').hide()
      }

      // Price
      if(!price){
        $('html, body').animate({
            scrollTop: $("#priceErrDiv").offset().top
        }, 2000);
        $('#priceErr').text("price is required!")
        return false;
      }else{
        $('#priceErr').hide()
      }

      // Image
      if(document.getElementById("req_image1").value.length == 0){
        // alert("saim");
        $('html, body').animate({
            scrollTop: $("#image1ErrDiv").offset().top
        }, 2000);
        $('#image1Err').text("Image 1 is required!")
        return false;
      }else{
        $('#image1Err').hide()
      }

      $( "#form-example-1" ).submit();

    });
});
</script>


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
    var slug = response['data'][i].slug;
    var name = response['data'][i].title;
    html += "<option value='"+slug+"'>"+name+"</option>";
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
    $('#product_sku').on('input',function(e) {
      $.get('{{ url('/vendor/product_sku') }}',
      {
        'title': $('#product_sku').val() },
        function( data ) {
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

    var vid = {{ Auth::guard('vendor')->user()->id }};
    var cat_id = $('#category_id').val();
    $('#sku-span').append().html(vid+'-'+cat_id+'-');
    $('#sku-slug-span').append().html(vid+'-'+cat_id+'-');
  </script>
  {{-- Show sub Categories --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

      <script type="text/javascript">
      function parentcategoryy(quantidade){
      // alert(quantidade);
      var vid = {{ Auth::guard('vendor')->user()->id }};
      var cat_id = $('#category_id').val();
      $('#sku-span').append().html(vid+'-'+cat_id+'-');
      $('#sku-slug-span').append().html(vid+'-'+cat_id+'-');
      
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