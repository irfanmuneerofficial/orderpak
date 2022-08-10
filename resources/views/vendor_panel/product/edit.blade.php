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
                  <!-- <h3>No image found!</h3> -->
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
                      <input id="slug" name="product_sku" class="form-control"  type="text" placeholder="sku" value="{{ $product->product_sku }}" class="required validate" required="">
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
                style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! $product->short_description !!}</textarea>
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
<!-- Attribute Add -->
<div class="row">
          <div class="showbox card col-md-12 border-bottom-1">
            <div class="row">
              <div class="pl-2 pt-md-3">
                  <label for="inputName" class="control-label"> Product Attributes</label>
              </div>
              <div class="col-md-1 pt-md-2">
              <button type="button" class="btn btn-success btn-md" onclick="add_more()"><i class="fa fa-plus"></i> ADD</button>
              </div>
            </div>
            <div class="row small">
                  <div class="col-md-2">
                      <label for="color_id" class="control-label ml-2"> Color</label>
                    </div>
                  <div class="col-md-1">
                      <label for="size_id" class="control-label ml-1"> Size</label>
                    </div>
                    <div class="col-md-1">
                      <label for="sku" class="control-label ml-2"> SKU</label>
                    </div>
                    <div class="col-md-1">
                      <label for="price" class="control-label ml-1"> Price</label>
                    </div>
                    <div class="col-md-1">
                      <label for="price" class="control-label ml-1"> Sale Price</label>
                    </div>
                    <div class="col-md-2">
                      <label for="price" class="control-label ml-1"> Sale Date</label>
                    </div>
                    <div class="col-md-1">
                      <label for="qty" class="control-label mt-0"> Qty</label>
                    </div>
                    <div class="col-md-2">
                      <label for="attr_image" class="control-label mt-0"> Image</label>
                    </div>
                    <div class="col-md-1">
                    <label for="status" class="control-label mt-0"> Status</label>
                    </div>
            </div>

      <div class="col-lg-12" id="product_attr_box">
        <div>
        @if(count($productAttrArr) >= 1)
          @php 
          $loop_count_num=0;
          @endphp
          @foreach($productAttrArr as $key=>$val)
          @php 
          $loop_count_prev=$loop_count_num;
          $pAArr=(array)$val;
          @endphp
            <div  id="product_attr_{{$loop_count_num++}}" class="product_attr"> 
            <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
            <input id="loop" type="hidden" class="spLoop" name="loop[]" value="{{$loop_count_num}}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <div id="inputFormRow" class="form-group colorpicker-component cp">
                      <select  id="color_id{{$key}}" name="color_id[]" class="form-control select2bs4"  style="width: 100%;">
                      <option value="">Select Color</option>
                      @foreach($colors as $row)
                      @if($pAArr['color_id']== $row->id)
                      <option value="{{$row->id}}" selected>{{$row->title}}</option>
                      @else
                      <option value="{{$row->id}}">{{$row->title}}</option>
                      @endif
                      @endforeach
                      </select>
                      <span class="text-danger" id="color_id{{$key}}skuErr"></span>
                      </div>
                  </div>
                  <div class="col-md-1">
                    <div id="inputFormRow" class="form-group colorpicker-component cp">
                      <select name="size_id[]" id="size_id{{$key}}".$key class="form-control select2bs4"  style="width: 100%;">
                      <option value="">Select Size</option>
                      @foreach($sizes as $row2)
                      @if($pAArr['size_id']==$row2->id)
                      <option value="{{$row2->id}}" selected>{{$row2->option_name}}</option>
                      @else
                      <option value="{{$row2->id}}">{{$row2->option_name}}</option>
                      @endif
                      @endforeach
                      </select>
                      <span class="text-danger" id="colorErr"></span>
                    </div>                             
                  </div>
                  <div class="col-md-1">
                    <input id="attr_sku{{$key}}" name="sku[]" type="text" class="form-control" autocomplete="off" aria-required="true" value="{{$pAArr['sku']}}"  aria-invalid="false" >
                  </div>
                  <div class="col-md-1">
                    <input id="attr_price{{$key}}" name="attr_price[]" type="text" autocomplete="off" maxlength="5" pattern=".{1,5}" onkeypress="return isNumber(event)" class="form-control" value="{{$pAArr['price']}}" aria-required="true" aria-invalid="false" >
                  </div>
                  <div class="col-md-1">
                    <!-- <label for="price" class="control-label mt-0"> Price</label> -->
                    <input id="attr_sale_price{{$key}}" name="attr_sale_price[]" type="text" autocomplete="off" maxlength="5" pattern=".{1,5}"  onchange="return isPriceSale('{{$key}}')"  onkeypress="return isNumber(event)" class="form-control attr_sale_price" value="{{$pAArr['attr_sale_price']==0?'':$pAArr['attr_sale_price']}}" aria-required="true" aria-invalid="false">
                  </div>
                  <div class="col-md-2" id="saledatetime">
                    <!-- <input type="text" required name="sale_details" id="sale_details" class="form-control float-right" /> -->
                    <input id="attr_sale_date{{$key}}" name="attr_sale_date[]" readonly type="text" class="readonly form-control attr-datepicker" value="{{$pAArr['attr_sale_date']}}" aria-required="true" aria-invalid="false">
                  </div>                  
                  <div class="col-md-1">
                    <input id="qty{{$key}}" name="qty[]" type="text" autocomplete="off" maxlength="4" pattern=".{1,4}" onkeypress="return isNumber(event)" class="form-control attr_qty" value="{{$pAArr['quantity']}}" aria-required="true" aria-invalid="false" >
                  </div>
                  <div class="col-md-2">
                    <input id="attr_image{{$key}}" name="attr_image[]" type="file" class="form-control" value="{{$pAArr['attr_image']}}" aria-required="true" aria-invalid="false">
                    <input hidden="" id="attr_req_image{{$key}}" value="{{$pAArr['attr_image']}}">
                    @if($pAArr['attr_image']!='')
                      <img width="100px" src="{{asset('uploads/product_images/'.$pAArr['attr_image'])}}"/>
                    @endif
                  </div>
                  <div class="col-md-1">
                  <div class="custom-control custom-switch">
                      <input type="checkbox" data-id="{{$pAArr['id']}}" class="toggle-class mt-4 custom-control-input" id="customSwitch{{$loop_count_num}}" name='attr_status[]' value='{{$pAArr['attr_status']}} '{{ $pAArr['attr_status'] == 1 ? 'checked' : '' }}>
                      <label class="custom-control-label mt-2" id="statusText" for="customSwitch{{$loop_count_num}}"></label>
                      @if($loop_count_num==1)
                      <!-- <button type="button" class="btn btn-success btn-md" onclick="add_more()"> 
                      <i class="fa fa-plus"></i>&nbsp;</button>                               -->
                      @else
                      <a href="{{url('vendor/product/product_attr_delete')}}/{{$pAArr['id']}}/{{$product->id}}">
                      <button type="button" class="btn btn-md">
                      <i class="fas fa-trash" style='color: red'></i></button></a>
                      @endif                                 
                      </div>                      
                                
                  </div>
                </div> 
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @else
      <div class="row">
                  <div class="col-md-2">
                    <div id="inputFormRow" class="form-group colorpicker-component cp">
                      <select  id="color_id0" name="color_id[]" class="form-control select2bs4"  style="width: 100%;">
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
                      <select name="size_id[]" id="size_id0".$key class="form-control select2bs4"  style="width: 100%;">
                      <option value="">Select Size</option>
                      @foreach($sizes as $row2)
                      <option value="{{$row2->id}}">{{$row2->option_name}}</option>
                      @endforeach
                      </select>
                      <span class="text-danger" id="sizeErr"></span>
                    </div>                             
                  </div>
                  <div class="col-md-1">
                    <input id="attr_sku0" name="sku[]" type="text" class="form-control" autocomplete="off" aria-required="true"  aria-invalid="false" >
                    <span class="text-danger" id="attr_skuErr"></span>
                  </div>
                  <div class="col-md-1">
                    <input id="attr_price0" name="attr_price[]" type="text" autocomplete="off" maxlength="5" pattern=".{1,5}" onkeypress="return isNumber(event)" class="form-control" aria-required="true" aria-invalid="false" >
                    <span class="text-danger" id="attr_priceErr"></span>
                  </div>
                  <div class="col-md-1">
                    <!-- <label for="price" class="control-label mt-0"> Price</label> -->
                    <input id="attr_sale_price0" name="attr_sale_price[]" type="text" autocomplete="off" maxlength="5" pattern=".{1,5}"  onchange="return isPriceSale('')"  onkeypress="return isNumber(event)" class="form-control attr_sale_price" aria-required="true" aria-invalid="false">
                    <span class="text-danger" id="attr_sale_priceErr"></span>
                  </div>
                  <div class="col-md-2" id="saledatetime">
                    <!-- <input type="text" required name="sale_details" id="sale_details" class="form-control float-right" /> -->
                    <input id="attr_sale_date0" name="attr_sale_date[]" readonly type="text" class="readonly form-control attr-datepicker" aria-required="true" aria-invalid="false">
                    <span class="text-danger" id="attrsaledateErr"></span>
                  </div>                  
                  <div class="col-md-1">
                    <input id="qty0" name="qty[]" type="text" autocomplete="off" maxlength="4" pattern=".{1,4}" onkeypress="return isNumber(event)" class="form-control attr_qty" aria-required="true" aria-invalid="false" >
                    <span class="text-danger" id="qtyErr"></span>

                  </div>
                  <div class="col-md-2">
                    <input id="attr_image0" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                    <input hidden="" id="attr_req_image0" value="">
                    <span class="text-danger" id="attr_imageErr"></span>
                  </div>
                  <div class="col-md-1">
                  </div>
                </div> 
              </div>
            </div>
        </div>
      </div>
      
      @endif
      </div>   
      </div>	            
<!-- Attribute Add End-->
            <!-- <div class="mt-3">
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
            </div> -->
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
            <div class="mt-3" id="sale-check-title">
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
                      <img id="pimage1" src="/uploads/product_images/{{ $product->image_1 }}" alt="{{ $product->image_1 }}" class="edit-image" style="width:25%">
                    </div>
                    @else
                    <!-- <h3>No image found!</h3> -->
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
                    <img id="pimage2" src="/uploads/product_images/{{ $product->image_2 }}" alt="{{ $product->image_2 }}" class="edit-image" style="width:25%">
                  </div>
                  @else
                  <!-- <h3>No image found!</h3> -->
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
                    <img id="pimage3" src="/uploads/product_images/{{ $product->image_3 }}" alt="{{ $product->image_3 }}" class="edit-image" style="width:25%">
                  </div>
                  @else
                  <!-- <h3>No image found!</h3> -->
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
                    <img id="pimage4" src="/uploads/product_images/{{ $product->image_4 }}" alt="{{ $product->image_4 }}" class="edit-image" style="width:25%">
                  </div>
                  @else
                  <!-- <h3>No image found!</h3> -->
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
                    <img id="pimage5" src="/uploads/product_images/{{ $product->image_5 }}" alt="{{ $product->image_5 }}" class="edit-image" style="width:50%">
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
                    <img id="pimage6" src="/uploads/product_images/{{ $product->image_6 }}" alt="{{ $product->image_6 }}" class="edit-image" style="width:25%">
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
            <div class="form-group">
                <div>
                    @if($product->variation != null)
                        @foreach($product->variation['color'] as $key => $value)
                            <div>
                                <span><b>Color name:</b> </span><p style="display: inline-block; background-color: #F0F0F0; padding: 7px; margin-left: 10px;">{{ $value['name'] }}</p><br />
                                <span><b>Color sizes:</b></span>
                                <p style="display: inline-block; background-color: #F0F0F0; padding: 7px; margin-left: 10px;">
                                    {{ implode(', ',$value['size']) }}
                                </p>
                                <p><img width="300" height="200" src="{{ asset('uploads/product_images').'/'.$value['color_image'] }}"></p><br />
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
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
  if(($("#qty").val() >=0 ))
  {
    // alert($("#qty").val());
    $("#sale-check-title").hide();
    $("#price").attr('readonly',true);
    $("#quantity").attr('readonly',true);  
  }
  
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

    //validate attribute 
        //validate attribute 
        if(($('#price').val() == 0) && ($('#quantity').val() == 0))
        {
            if(document.getElementById("color_id0").value.length == 0)
            {
              // alert('Color Required'+$("#color_id").val());
              $('html, body').animate({
                  scrollTop: $("#color_id0").offset().top
              }, 2000);
              $('#colorErr').text("Color is required!");
              return false;
            }
            else{
              $('#colorErr').hide();
            }

            if($("#attr_sku0").val() =='')
            {
              // alert('SKU Required');
              $('html, body').animate({
                  scrollTop: $("#attr_sku0").offset().top
              }, 2000);
              $('#attr_skuErr').text("SKU is required!");
              return false;
            }
            else{
              $('#attr_skuErr').hide();
            }      

            if($("#attr_price0").val() =='')
            {
              // alert('Price Required');
              $('html, body').animate({
                  scrollTop: $("#attr_price0").offset().top
              }, 2000);
              $('#attr_priceErr').text("Price is required!");
              return false;
            }
            else{
              $('#attr_priceErr').hide();
            }

            //------------------SALEPRICEANDDATE----------------------
            if( ($("#attr_sale_date0").val() == '') )
            {
                if($("#attr_sale_price0").val() != '')
                {
                  alert('Please Select Sale Date');
                  $('html, body').animate({
                  scrollTop: $("#attr_sale_date0").offset().top
                  }, 2000);
                  $('#attrsaledateErr').text("Sale Date is required!");
                  return false;
                }
            }
            else{
                $('#attrsaledateErr').hide();
            }

            if($("#attr_sale_date0").val() != '')
            { 
              // alert(parseInt($("#attr_sale_price").val()));
              if( ($("#attr_sale_price0").val() == '')|| ($("#attr_sale_price0").val() == 0))
              {
                alert('Sale Price is required');
                $('html, body').animate({
                scrollTop: $("#attr_sale_price0").offset().top
                }, 2000);
                $('#attr_sale_priceErr').text("Sale Price is required!");
                return false;
              }
              else{
              $('#attr_sale_priceErr').hide();
              }
            }
            //------------------SALEPRICEANDDATE----------------------

            if($("#qty0").val() =='')
            {
              // alert('Quantity Required');
              $('html, body').animate({
                  scrollTop: $("#qty0").offset().top
              }, 2000);
              $('#qtyErr').text("Quantity is required!");
              return false;
            }      
            else{
              $('#qtyErr').hide();
            }
            // if(document.getElementById("attr_req_image"+index).value.length == 0)
            if($("#attr_image0").val()=='' && document.getElementById("attr_req_image0").value.length == 0)
            {
              // alert($("#attr_image0").val());
              // alert('Variation Image Required');
              $('html, body').animate({
                  scrollTop: $("#attr_image0").offset().top
              }, 2000);
              $('#attr_imageErr').text("Image is required!0");
              return false;
            }      
            else{
              $('#attr_imageErr').hide();
            }
            // alert($('input[name^="loop"]').length);
            var input = document.getElementsByName('loop[]');
            // alert(input.length);
            if(input.length>0)
            {
                var input = document.getElementsByName('loop[]');
              for (var i = 0; i < $('input[name^="loop"]').length; i++) 
              {
                        var index = input[i].value;
                        // alert('index: '+index);

                        var color = "#color_id"+index;
                        var color2 = "color_id"+(index-1);
                        // alert('color2: '+color2);
                        // alert(document.getElementById(color2).value.length);
                        if(document.getElementById(color2).value.length == 0)
                        {
                        // alert('im in the selected color box'+color);
                        $('html, body').animate({
                            scrollTop: $(color).offset().top
                        }, 2000);
                        $("#color_id"+index+"skuErr").text("Color is required!");
                        return false;
                        }
                        else{
                        $("#color_id"+index+"skuErr").hide();
                        }

                        if($("#attr_sku"+index).val() =='')
                        {
                        // alert("attr_sku"+index);          
                        $('html, body').animate({
                        scrollTop: $("#attr_sku"+index).offset().top
                        }, 2000);
                        $("#attr_sku"+index).css("border", "1px solid red");
                        alert('SKU Required');
                        return false;
                        }
                        else{
                        $("#attr_sku"+index).css("border", "1px solid #000");
                        }      

                        if($("#attr_price"+index).val() =='')
                        {
                          $('html, body').animate({
                          scrollTop: $("#attr_price"+index).offset().top
                          }, 2000);
                          alert('Attribute Price Required');
                          $("#attr_price"+index).css("border", "1px solid red");
                          return false;
                        }
                        else{
                          $("#attr_price"+index).css("border", "1px solid #000");
                        }

                        //------------------SALEPRICEANDDATE----------------------
                        if( ($("#attr_sale_date"+index).val() == '') )
                        {
                            if($("#attr_sale_price"+index).val() != '')
                            {
                              alert('Please Select Sale Date');
                              $('html, body').animate({
                              scrollTop: $("#attr_sale_date"+index).offset().top
                              }, 2000);
                              $("#attr_sale_date"+index).css("border", "1px solid red");
                              return false;
                            }
                            else{
                              $("#attr_sale_date"+index).css("border", "1px solid #000");
                            }
                        }
                        else{
                            $("#attr_sale_date"+index).css("border", "1px solid #000");
                        }

                        if($("#attr_sale_date"+index).val() != '')
                        {
                          if( ($("#attr_sale_price"+index).val() == '')|| ($("#attr_sale_price"+index).val() == 0))
                          {
                              alert('Sale Price is required');
                              $('html, body').animate({
                              scrollTop: $("#attr_sale_price"+index).offset().top
                              }, 2000);
                              $("#attr_sale_price"+index).css("border", "1px solid red");
                              return false;
                          }
                          else{
                              $("#attr_sale_price"+index).css("border", "1px solid #000");
                          }
                        }
                        else{
                            $("#attr_sale_price"+index).css("border", "1px solid #000");
                        }
                        //------------------SALEPRICEANDDATE----------------------
                        if($("#qty"+index).val() =='')
                        {
                            $('html, body').animate({
                            scrollTop: $("#qty"+index).offset().top
                            }, 2000);
                            alert('Attribute Quantity Required');
                            $("#qty"+index).css("border", "1px solid red");
                            return false;
                        }      
                        else{
                            $("#qty"+index).css("border", "1px solid #000");
                        }
                        // alert('filename: '+$("#attr_image"+index).val());
                        // alert('size: '+document.getElementById("attr_req_image"+index).value.length);
                        if($("#attr_image"+index).val() =='' && document.getElementById("attr_req_image"+index).value.length == 0)
                        {
                          $('html, body').animate({
                          scrollTop: $("#attr_image"+index).offset().top
                          }, 2000);
                          alert('Attribute Image Required'+index);
                          $("#attr_image"+index).css("border", "1px solid red");
                          return false;
                        }      
                        else{
                          $("#attr_image"+index).css("border", "1px solid #000");
                        } 
            }   //for loop
          }
        }    //if qty=0 and price=0
    //validate attribute
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
  // alert(saim);
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

  $(document).on("focus", ".attr-datepicker", function(){
    var dateToday = new Date();
      $(this).daterangepicker({
      // timePicker: true,
      minDate: dateToday,
      autoUpdateInput: false,
      locale: {
      cancelLabel: 'Clear'
      }
    });

    $(this).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $(this).on('cancel.daterangepicker', function(ev, picker) {
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
  <script>

  var length = $('.product_attr').length;
  // alert(length);
  if(length == 0)
  {
    var loop_count=1; 
    
  }else{
    var loop_count=length-1; 
  }
  
  function add_more(){
      loop_count++;
      var html='<div id="product_attr_'+loop_count+'" class="product_attr mt-2">';
      html+='<input id="loop" type="hidden" class="spLoop" name="loop[]" value="'+loop_count+'">';
      html+='<input id="paid" type="hidden" name="paid['+loop_count+']">';
      html+='<div><div class="form-group"><div class="row">';
      if(length == 0)
      {
        var color_id_html=jQuery('#color_id0').html(); 
      }else{
        var color_id_html=jQuery('#color_id0').html(); 
      }
      // alert($('.product_attr').length);
      html+='<div class="col-md-2"><span class="text-danger" id="color_id'+loop_count+'skuErr"></span><select id="color_id'+loop_count+'" name="color_id['+loop_count+']" class="form-control" >'+color_id_html+'</select></div>';
      var size_id_html=jQuery('#size_id0').html(); 
      html+='<div class="col-md-1"><select id="size_id'+loop_count+'" name="size_id['+loop_count+']" class="form-control">'+size_id_html+'</select></div>';
      html+='<div class="col-md-1"><input id="attr_sku'+loop_count+'" name="sku['+loop_count+']" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>'; 
      html+='<div class="col-md-1"><input id="attr_price'+loop_count+'" name="attr_price['+loop_count+']" maxlength="5" pattern=".{1,5}" onkeypress="return isNumber(event)" type="text" class="form-control attr_sale_price" aria-required="true" aria-invalid="false"></div>';
      html+='<div class="col-md-1"><input id="attr_sale_price'+loop_count+'" name="attr_sale_price['+loop_count+']" maxlength="5" pattern=".{1,5}" onchange="return isPriceSale('+loop_count+')"  onkeypress="return isNumber(event)" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';
      html+='<div class="col-md-2"><input id="attr_sale_date'+loop_count+'" readonly name="attr_sale_date['+loop_count+']" style="background-color:white" type="text" class="form-control attr-datepicker" aria-required="true" aria-invalid="false"></div>';
      html+='<div class="col-md-1"><input id="qty'+loop_count+'" name="qty['+loop_count+']" type="text" maxlength="4" pattern=".{1,4}" onkeypress="return isNumber(event)" class="form-control attr_qty" aria-required="true" aria-invalid="false"></div>';
      html+='<div class="col-md-2"><input id="attr_image'+loop_count+'" name="attr_image['+loop_count+']" type="file" class="form-control" aria-required="true" aria-invalid="false"><input hidden="" id="attr_req_image'+loop_count+'"></div>';
      html+='<div class="col-md-1"><button type="button" class="btn btn-danger btn-md" onclick=remove_more("'+loop_count+'")><i class="fas fa-trash"></i>&nbsp;</button></div>'; 
      html+='</div></div></div></div>';
      jQuery('#product_attr_box').append(html)
  }

    function remove_more(loop_count){
    jQuery('#product_attr_'+loop_count).remove();
    }

    var loop_image_count=1; 
    function add_image_more(){
    loop_image_count++;
    var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
    //product_images_box
    html+='<div class="col-md-2 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
    jQuery('#product_images_box').append(html)
    }

    function remove_image_more(loop_image_count){
    jQuery('.product_images_'+loop_image_count).remove();
    }            

    $(function() {
    $('.toggle-class').change(function() {
      // alert('toggle working');
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var att_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/vendor/changeAttrStatus',
            data: {'status': status, 'att_id': att_id},
            success: function(data){
              // console.log(data.success)
              // alert('Status Updated');
            }
        });
    })
  })    

function isNumber(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
return true;
}  

function isPriceSale(spid)
{
  var attr_price = $('#attr_price'+spid).val();
  var sale_attr_price = $('#attr_sale_price'+spid).val();
  if(parseInt(attr_price) > parseInt(sale_attr_price))
  {
    // alert('Sale Price must be less than Price ');
  }else{
    alert('Sale Price must be less than Price');
    $('#attr_sale_price'+spid).val('');
  $('#attr_sale_price'+spid).focus();

  }
  return true;
}    

$(':input[readonly]').css({'background-color':'#ffffff'});
    </script>
@endsection