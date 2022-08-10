@extends('vendor_panel.layouts.master')
@section('title')
Manage Images
@endsection
@section('main-content')
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
  {{--  <form name="form-example-1" id="form-example-1" action="{{url('/vendor/product/images', [$product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Manage Images</h3>
          </div>
          <div class="card-body">
            <form name="form-example-1" id="form-example-1" action="{{url('/vendor/product/images/', [$product->id]) }}/" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div id="inputFormRow2">
                      <label for="inputName">Image 1 (Main)</label>
                      <input type="file" name="image_1" class="form-control m-input" autocomplete="off">
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
              <div class="row">
                <div class="col-12">
                  <a href="#" class="btn btn-secondary">Back</a>
                  <input type="submit" value="Create new Porject" class="btn btn-success float-right">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Uploaded Images</h3>
          </div>
          <div class="card-body">
            <div class="row">



              <form name="form-example-1" id="form-example-1" action="{{url('/vendor/product/images/', [$product->id]) }}/" method="post" enctype="multipart/form-data">
                @csrf
                @method('delete')
                  <div class="col-md-6">
                    <div class="form-group">
                      <div id="inputFormRow2">
                        <label for="inputName">Image 1 (Main)</label>
                        @if(!$productImages ==  null)
                        
                        {{-- <h2>saim</h2> --}}
                        <div class="mutli-img-edit">
                          <input type="hidden" name="id" value="{{ $productImages->id }}">
                          <img src="/uploads/product_images/{{ $productImages->image_1 }}" alt="{{ $productImages->image_1 }}" class="edit-image" style="width:100%">
                          <br>
                          <div class="middle-btn">
                            <button type="submit" id="dlt-img" class="btn btn-danger">Remove Image</button>
                          </div>
                        </div>
                        @else
                          <h1>No image found</h1>
                          @endif
                      </div>
                      <br>
                    </div>
                  </div>
                </form>
              

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
            <div class="row">
              <div class="col-12">
                <a href="#" class="btn btn-secondary">Back</a>
                <input type="submit" value="Create new Porject" class="btn btn-success float-right">
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
$("#addRow2").click(function () {
var html = '';
html += '<div id="inputFormRow2">';
  html += '<div class="input-group mb-3">';
    html += '<input type="file" name="images[]" class="form-control m-input" autocomplete="off">';
    html += '<div class="input-group-append">';
      html += '<button id="removeRow2" type="button" class="btn btn-danger">Remove</button>';
    html += '</div>';
  html += '</div>';
  $('#newRow2').append(html);
  });
  // remove row
  $(document).on('click', '#removeRow2', function () {
  $(this).closest('#inputFormRow2').remove();
  });
  </script>
  @endsection