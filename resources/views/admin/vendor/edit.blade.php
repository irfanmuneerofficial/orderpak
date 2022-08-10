@extends('admin.layouts.master')
@section('page-title')
Add Commission
@endsection
@section('mainContent')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Vendor</h1>
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
  <div class="col d-flex justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Edit Vendor</h3>
                    </div>
                    
                    <div class="card-body">
                    <form name="form-example-1" id="form-example-1" action="/admin/vendor/update/{{ $vendor->id }}/" method="post">
                    @csrf
                   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{$vendor->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{$vendor->last_name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input value="{{$vendor->business_name}}" class="form-control" id="business_name" name="business_name" type="text"  required="">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="business_email">Business Email</label>
                                    <input value="{{$vendor->business_email}}" class="form-control" id="business_email" name="business_email" type="email"  required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="business_address">Business Address</label>
                                    <input value="{{$vendor->business_address}}" class="form-control" id="business_address" name="business_address" type="text"  required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cnic">Cnic</label>
                                    <input type="text" class="form-control"  data-inputmask="'mask': '99999-9999999-9'" id="cmic"  placeholder="XXXXX-XXXXXXX-X" value="{{ $vendor->cnic }}"  name="cnic" required="" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_no">Phone No</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text prepend-input" id="">+92</span>
                                        </div>
                                        <input maxlength="10"  value="{{$vendor->phone_no}}" class="form-control input-phone" id="phone_no" name="phone_no" type="text" autocomplete="off" required="" placeholder="3456789048">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alternate_phone_no">Alternate Phone No</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text prepend-input" id="">+92</span>
                                        </div>
                                        <input maxlength="10" value="{{$vendor->alternate_phone_no}}" class="form-control input-phone" id="alternate_phone_no" name="alternate_phone_no" type="text" autocomplete="off" required="" placeholder="3456789096">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input required type="text" id="city" name="city" class="form-control" value="{{$vendor->city}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select required name="state" id="state" class="form-control">
                                        <option {{ ( strtolower($vendor->state) == "sindh" ? "selected":"") }} value="sindh">Sindh</option>
                                        <option {{ ( strtolower($vendor->state) == "punjab" ? "selected":"") }} value="punjab">Punjab</option>
                                        <option {{ ( strtolower($vendor->state) == "balochistan" ? "selected":"") }} value="balochistan">Balochistan</option>
                                        <option {{ ( strtolower($vendor->state) == "gilgit-baltistan" ? "selected":"") }} value="gilgit-baltistan">Gilgit-Baltistan</option>
                                        <option {{ ( strtolower($vendor->state) == "khyber pakhtunkhwa" ? "selected":"") }} value="khyber pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary" name="update_vendor">Update</button>
                                   <a href="{{ url('admin/vendors') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>

                    </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    
                    <div class="card-body">
                    <form name="form-example-1" id="form-example-1" action="/admin/vendor/change_password/{{ $vendor->id }}/" method="post">
                    @csrf
                   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input  required type="password" id="password" name="password" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirmation_password">Confirm Password</label>
                                    <input required type="password" id="confirm_password" name="confirm_password" class="form-control confirm_password" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-primary" name="change_password">Update</button>
                                   <a href="{{ url('admin/vendors') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            
        </div>
    </div>
</section>
</div>

@push('vendor-edit-script')
<script type="text/javascript">
    jQuery("#cmic").inputmask();
    
    $('.input-phone').on('keyup', function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
</script>
@endpush

@endsection