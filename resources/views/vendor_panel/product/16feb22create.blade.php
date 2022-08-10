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
@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}  
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
</div> 
@enderror
@error('images.*')
  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
  {{$message}}  
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
    </button>
  </div> 
@enderror
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
            <div class="form-group" id="titleErrDiv">
              <label for="inputName">Product Title (Required)</label>
              <input type="text" name="title" id="title" class="form-control">
              <span class="text-danger" id="titleErr"></span>
            </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group" id="categoryErrDiv">
                    <label>Select Category (Required)</label>
                    <select name="category_id" id="category_id" required onchange="parentcategory(this.value)" required class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Category</option>
                      @foreach($category as $data)
                      <option value="{{$data->id}}"> {{$data->title}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="categoryErr"></span>
                  </div>
                </div>
                <div class="col-md-4" id="parentCatErrDiv">
                  <div class="form-group" id="parentselect" required style="display:none;">
                    <label>Select Sub Category (Required)</label>
                    <select name="parent_id" id="select2" onchange="childcategory(this.value)" required class="form-control select2bs4" style="width: 100%;">
                      <option value="">Select Sub Category</option>
                    </select>
                    <span class="text-danger" id="parentCatErr"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group" id="childselect" style="display:none;">
                    <label>Select Child Category</label>
                    <select name="child_id" id="select3" class="form-control select2bs4"  style="width: 100%;">
                      <option value="">Select Child Category</option>
                    </select>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="brandErrDiv">
                  <label>Brand (Required)</label>
                  <input type="text" name="brand_id" id="brand_id" required class="form-control">
                  <span class="text-danger" id="brandErr"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <!-- <label>Size Chart Image</label>
                  <input type="file" name="size_chart" class="form-control m-input" autocomplete="off" > -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Model</label>
                  <input type="text" name="model" id="model" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="skuErrDiv">
                  <label for="inputName">SKU (Required)</label>
                  <span id="error-sku" class="alert-danger"></span>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="sku-span"></span>
                      <input type="text" name="productsku" id="product_sku" class="form-control" required="">
                      <input hidden="" name="vendor_id" value="{{Auth::guard('vendor')->user()->id}}">
                  </div>
                  {{-- <span class="text-danger" id="skuErr"></span> --}}
                  
                  <span class="text-danger" id="skuErr"></span>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="sku-slug-span"></span>
                      <input id="slug" name="product_sku" class="form-control" readonly="" type="text" placeholder="sku" class="required validate" required="">
                  </div>
                  <span class="text-danger" id="slugErr"></span>
                  <div class="alert-danger" id="error-sku"></div>
                </div>
              </div>
            </div>
            <div class="form-group" id="short_descriptionErrDiv">
              <label for="inputDescription">Short Description (Required)</label>
              <span class="text-danger" id="short_descriptionErr"></span>
              <div class="mb-3">
                <textarea name="short_description" id="short_description" maxlength="1200"  placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              </div>
            </div>
            <div class="form-group" id="product_descriptionErrDiv">
              <label for="inputDescription">Product Description (Required)</label>
              <span class="text-danger" id="product_descriptionErr"></span>
              <div class="mb-3">
                <textarea id="textarea-product-desc" name="product_description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Additional Details</label>
              <div class="mb-3">
                <textarea id="textarea-product-addition" name="additional_details" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>
            <div class="form-group">
          </div>
          <div class="row">
            <div class="card col-md-12 border-bottom-1">
            <label for="inputName">Product Attributes</label>
            <div class="row small">
            <div class="col-md-1">
                <label for="color_id" class="control-label ml-3"> Color</label>
              </div>
            <div class="col-md-1">
                <label for="size_id" class="control-label ml-3"> Size</label>
              </div>
              <div class="col-md-2">
                <label for="sku" class="control-label ml-3"> SKU</label>
              </div>
              <div class="col-md-1">
                <label for="price" class="control-label ml-3"> Price</label>
              </div>
              <div class="col-md-1">
                <label for="qty" class="control-label mt-0"> Qty</label>
              </div>
              <div class="col-md-2">
                <label for="attr_image" class="control-label mt-0"> Image</label>
              </div>
              <div class="col-md-1">
                <label for="attr_image" class="control-label mt-0">&nbsp;</label>
              </div>
            </div>

            <div class="col-lg-12" id="product_attr_box">
              <div>
                  <div > 
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-1">
                            <div id="inputFormRow" class="form-group colorpicker-component cp">
                            <select  id="color_id" name="color_id[]" class="form-control select2bs4" required style="width: 100%;">
                            <option value="">Select Color</option>
                              @foreach($colors as $row)
                              <option value="{{$row->id}}">{{$row->title}}</option>
                              @endforeach
                            </select>
                            <span class="text-danger" id="colorErr"></span>
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div id="inputFormRow" class="form-group colorpicker-component cp">
                                <select name="size_id[]" id="size_id" class="form-control select2bs4" required style="width: 100%;">
                                <option value="">Select Size</option>
                                  @foreach($sizes as $row2)
                                    <option value="{{$row2->id}}">{{$row2->option_name}}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger" id="colorErr"></span>
                            </div>                             
                          </div>
                          <div class="col-md-2">
                              <!-- <label for="sku" class="control-label mt-0"> SKU</label> -->
                              <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                          </div>
                          <div class="col-md-1">
                              <!-- <label for="price" class="control-label mt-0"> Price</label> -->
                              <input id="attr_price" name="attr_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                          </div>
                          <div class="col-md-1">
                              <!-- <label for="qty" class="control-label mt-0"> Qty</label> -->
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                          </div>
                          <div class="col-md-2">
                              <!-- <label for="attr_image" class="control-label mt-0"> Image</label> -->
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false">

                          </div>
                          <div class="col-md-1">
                              <!-- <label for="attr_image" class="control-label mt-0">Action</label> -->
                                <button type="button" class="btn btn-success btn-md" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp;</button>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
       <div>
        <!--  <div class="mt-3">
            <label for="size-check">Allow Product Sizes</label>
            <input name="size_check" type="checkbox" class="form-check" id="size-check" value="1">
            <br>
            <div class="showbox" id="size-display">
              <div class="product-size-details" id="size-section">
                <div class="size-area">
                  <div class="mb-3">
                        <label>
                          Size Name :<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>
                        </label>
                        <input type="text" name="size_name[]" id="size_name" required class="form-control size_name" placeholder="Size Name">
                        <span class="text-danger" id="sizenameErr"></span>
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
                      <select name="colors[]" id="colors" class="form-control select2bs4" required style="width: 100%;">
                        <option value="">Select Color</option>
                        @foreach($colors as $row)
                        <option value="{{$row->title}}">{{$row->title}}</option>
                        @endforeach
                      </select>
                        <span class="text-danger" id="colorErr"></span>
                    </div>
                    <div id="newRow"></div>
                  </div>
                </div>
                <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </div> -->
          <br>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="conditionErrDiv">
                <label for="inputName">Condition</label>
                <span class="text-danger" id="conditionErr"></span>
                <select name="condition" id="condition" class="form-control select2bs4" required style="width: 100%;">
                    <option value="">Select Condition</option>
                    <option value="Fresh">Fresh</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                    <option value="Refurbished">Refurbished</option>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="quantityErrDiv">
                <label for="inputName">Quantity (Required)</label>
                <span class="text-danger" id="quantityErr"></span>
                <input type="number" name="quantity" id="quantity" class="form-control"  maxlength="6" min="0"  max="6" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="priceErrDiv">
                <label for="inputName">Price (Required)</label>
                <span class="text-danger" id="priceErr"></span>
                <input type="number" name="price" id="price" min="0" class="form-control" onwheel="this.blur()" required>
              </div>
            </div>
          </div>
          <div class="mt-3">
            <label for="sale-check">Allow Product Sale</label>
            <input name="sale_status" type="checkbox" class="form-check" id="sale-check" value="1">
            <div class="row" id="sale-display">
              <div class="col-md-6">
                <div id="saleprice" class="form-group">
                  <label>Sale Price</label>
                    <span class="text-danger" id="salepriceErr"></span>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rs.</span>
                    </div>
                    <input type="number" required name="sale_price" id="sale_price" min="0" class="form-control float-right" onwheel="this.blur()"/>
                  </div>
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
                    <input type="text" required name="sale_details" id="sale_details" class="form-control float-right" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <div class="form-group">
              <label>Tags</label>
              <br/>
              <input id="tags" class="form-control" required data-role="tagsinput" type="text" name="tags">
            </div>
          </div>
          <br>
            <h4 class="bold"> <lable for="inputName">Video URL</label></h4>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group" id="video1ErrDiv">
                    <div id="inputFormRow2">
                      <input type="text" name="video_1" id="video_1" class="form-control m-input" placeholder="vido url e.g: http://youtube.com/fsd2" autocomplete="off" required>
                      <span class="text-danger" id="video1Err"></span>                  
                    </div>
                    <br>
                  </div>
                </div>
          </div>
            <h4 class="bold"> <lable for="inputName">Image Section</label></h4>
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="image1ErrDiv">
                <div id="inputFormRow2">
                  <label for="inputName">Image 1 (Required)</label>
                  <input type="file" name="image_1" id="image_1" class="form-control m-input" autocomplete="off" required>
                  <span class="btn btn-danger" id="closeimage1">Remove</span>                  
                  <span class="text-danger" id="image1Err"></span>                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 2</label>
                  <input type="file" name="image_2" id="image_2" class="form-control m-input" autocomplete="off">
                  <span class="btn btn-danger" id="closeimage2">Remove</span>                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 3</label>
                  <input type="file" name="image_3" id="image_3" class="form-control m-input" autocomplete="off">
                  <span class="btn btn-danger" id="closeimage3">Remove</span>                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 4</label>
                  <input type="file" name="image_4" id="image_4" class="form-control m-input" autocomplete="off">
                  <span class="btn btn-danger" id="closeimage4">Remove</span>                  
                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 5</label>
                  <input type="file" name="image_5" id="image_5" class="form-control m-input" autocomplete="off">
                  <span class="btn btn-danger" id="closeimage5">Remove</span>                  
                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div id="inputFormRow2">
                  <label for="inputName">Image 6</label>
                  <input type="file" name="image_6" id="image_6" class="form-control m-input" autocomplete="off">
                  <span class="btn btn-danger" id="closeimage6">Remove</span>                  
                  
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-6">
                <h4>Size Chart Image</h4>
                <div class="form-group">
                  <!-- <label>Size Chart Image</label> -->
                  <input type="file" name="size_chart" class="form-control m-input" autocomplete="off" >
                </div>
            </div>
            
          </div>
          <hr>
          <div class="form-group">
          <h4> <lable for="inputName">Warranty Details</label></h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Warranty Type</label>
              <input type="text" name="warrenty_type" id="warrenty_type" class="form-control" placeholder="Ex: Company, Local" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputName">Warranty Period</label>
              <input type="text" name="warrenty_period" id="warrenty_period" class="form-control" placeholder="Ex: 3 months, 1 year" >
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputDescription">Warranty Policy</label>
          <textarea id="inputDescription" name="warrenty_policy" id="warrenty_policy" class="form-control" rows="4"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" id="upload" class="btn btn-success float-right">Submit Product</button>
  </div>
</div>

</form>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
      var product_description = $('#textarea-product-desc').val(); 
      var quantity = $('#quantity').val(); 
      var price = $('#price').val();
      var color_check = $('#colors').val();
      var size_check = $('#size_name').val();
      var sale_price = $('#sale_price').val();
      var sale_details = $('#sale_details').val();
      var image1 = $('#image_1').val(); 
      
      if($('#sale-check').prop('checked')){
        if(title !='' && category!='' && category!='' && parentCat!='' && brand!='' && sku!='' && slug!='' && short_description!='' && product_description!='' && quantity!='' && price!='' && sale_price!='' && sale_details!='' && image1!='' )
        {
            $('#upload').attr('disabled',true);
        }
      }
      else if($('#color-check').prop('checked'))
      {
        if(title !='' && category!='' && category!='' && parentCat!='' && brand!='' && sku!='' && slug!='' && short_description!='' && product_description!='' && quantity!='' && price!='' && color_check!='' && image1!='' )
        {
            $('#upload').attr('disabled',true);
        }
      }
      else if($('#size-check').prop('checked')){
        if(title !='' && category!='' && category!='' && parentCat!='' && brand!='' && sku!='' && slug!='' && short_description!='' && product_description!='' && quantity!='' && price!='' && size_check!='' && image1!='' )
        {
            $('#upload').attr('disabled',true);
        }
      }
      else
      {
        if(title !='' && category!='' && category!='' && parentCat!='' && brand!='' && sku!='' && slug!='' && short_description!='' && product_description!='' && quantity!='' && price!='' && image1!='' )
        {
            $('#upload').attr('disabled',true);
        }
      }
        
      
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
            scrollTop: $("#parentCatErrDiv").offset().top
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
      if(!slug){
        $('html, body').animate({
            scrollTop: $("#slugErrDiv").offset().top
        }, 2000);
        $('#skuErr').text("slug is required!")
        return false;
      }else{
        $('#skuErr').hide()
      }

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
    
      // Product Description
      if(!product_description){
        $('html, body').animate({
            scrollTop: $("#product_descriptionErrDiv").offset().top
        }, 2000);
        $('#product_descriptionErr').text("Product Description is required!")
        return false;
      }else{
        $('#product_descriptionErr').hide()
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

      // Image 1
      if(!image1){
        $('html, body').animate({
            scrollTop: $("#image1ErrDiv").offset().top
        }, 2000);
        $('#image1Err').text("image 1 is required!")
        return false;
      }else{
        $('#image1Err').hide()
      }
    $( "#form-example-1" ).submit();

    });
});
</script>

<script type="text/javascript">
	$("#closeimage1").hide();
	$("#image_1").change(function(){
		$("#closeimage1").show();
    });
    $("#closeimage1").on("click", function (e) {
    	$('#image_1').val('');
		$("#closeimage1").hide();
    });

	$("#closeimage2").hide();
	$("#image_2").change(function(){
		$("#closeimage2").show();
    });
    $("#closeimage2").on("click", function (e) {
    	$('#image_2').val('');
		$("#closeimage2").hide();
    });

	$("#closeimage3").hide();
	$("#image_3").change(function(){
		$("#closeimage3").show();
    });
    $("#closeimage3").on("click", function (e) {
    	$('#image_3').val('');
		$("#closeimage3").hide();
    });

	$("#closeimage4").hide();
	$("#image_4").change(function(){
		$("#closeimage4").show();
    });
    $("#closeimage4").on("click", function (e) {
    	$('#image_4').val('');
		$("#closeimage4").hide();
    });

	$("#closeimage5").hide();
	$("#image_5").change(function(){
		$("#closeimage5").show();
    });
    $("#closeimage5").on("click", function (e) {
    	$('#image_5').val('');
		$("#closeimage5").hide();
    });

	$("#closeimage6").hide();
    $("#image_6").change(function(){
		$("#closeimage6").show();
    });
    $("#closeimage6").on("click", function (e) {
    	$('#image_6').val('');
		$("#closeimage6").hide();
    });
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
          html += '<select name="colors[]" id="colors" class="form-control select2bs4" required style="width: 100%;">';
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
  $('#product_sku').on('input',function(e) {
    //   alert($('#product_sku').val());
    $.get('{{ url('/vendor/product_sku') }}',
      { 
        'title': $('#product_sku').val() }, 
        function( data ) {
        // alert(data.slug);
        if(data.error){
          $('#error-sku').text(data.error);
          // $('#slug').val(data.error);
          $('#product_sku').val(null);
          $('#slug').val(null);
        }
        else{
          $('#error-sku').text(null);
          $('#slug').val(data.slug);
        //   $('#product_sku').val(data.slug);
        }
      });
  });

  $('#sku-span').hide();
  $('#sku-slug-span').hide();

</script>
{{-- Show sub Categories --}}


<script type="text/javascript">
function parentcategory(quantidade){
  
  $('#sku-span').show();
  $('#sku-slug-span').show();
  var vid = {{ Auth::guard('vendor')->user()->id }}
  var cat_id = $('#category_id').val();
  $('#sku-span').append().html(vid+'-'+cat_id+'-');
  $('#sku-slug-span').append().html(vid+'-'+cat_id+'-');
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
        $('#sku-span').hide();
        $('#sku-slug-span').hide();
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

var max_chars = 5;
$('#quantity').keydown( function(e){
    if ($(this).val().length >= max_chars) { 
        $(this).val($(this).val().substr(0, max_chars));
    }
});
</script>
<script>
  var loop_count=1; 
  function add_more(){
      loop_count++;
      var html='<input id="paid" type="hidden" name="paid[]">';
      html+='<div id="product_attr_'+loop_count+'">';
      html+='<div><div class="form-group"><div class="row">';
      var color_id_html=jQuery('#color_id').html(); 
      html+='<div class="col-md-1"><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';
      var size_id_html=jQuery('#size_id').html(); 
      html+='<div class="col-md-1"><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';
      html+='<div class="col-md-2"><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 
      html+='<div class="col-md-1"><input id="attr_price" name="attr_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-1"><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-2"><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-1"><button type="button" class="btn btn-danger btn-md" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp;</button></div>'; 
      html+='</div></div></div></div>';
      jQuery('#product_attr_box').append(html)
  }
  function remove_more(loop_count){
      jQuery('#product_attr_'+loop_count).remove();
  }
</script>
@endsection