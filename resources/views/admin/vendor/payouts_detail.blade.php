@extends('admin.layouts.master')
@section('mainContent')
<div class="content-wrapper">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Sorry!</strong> There were more problems.<br><br>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Vendors</h1>
            </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Vedors</li>
            </ol>
        </div>
    </div>
  </div>
<!-- /.container-fluid -->
</section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  <div class="tab-pane" id="timeline">
                    <ul class="timeline timeline-inverse">
                        <li></li>
                      <li>
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>First & Last Name :</b>{{$payout->first_name}} {{$payout->last_name}}</h3>
                        </div>
                      </li>
                      <li>
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>Date Of Birth :</b> {{$payout->date_of_birth}}</h3>
                        </div>
                      </li>
                      <li>
                    <li>
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>SSN :</b>{{$payout->ssn}}</h3>
                        </div>
                      </li>
                       <li>	
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>Address :</b>{{$payout->address}}</h3>
                        </div>
                      </li>
                      <li>	
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>Coutry :</b>{{$payout->country}}</h3>
                        </div>
                      </li>
                      <li>	
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>Routing No :</b>{{$payout->routing_no}}</h3>
                        </div>
                      </li>
                      <li>	
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><b>Account No :</b>{{$payout->account_no}}</h3>
                        </div>
                      </li>
                      <li >	
                        <i class="fa fa-dot-circle-o bg-blue"></i>
                        <div class="timeline-item col-md-5">
                          <h3 class="timeline-header no-border"><b>Front ID Card Image:</b>
                          </h3>
                            <img class="img-responsive" src="/uploads/{{$payout->id_front}}" style="width: 500px;height: 500px;" alt="Photo">
                        </div>
                        <div class="timeline-item col-md-5">
                          <h3 class="timeline-header no-border"><b>Back ID Card Image:</b>
                          </h3>
                            <img class="img-responsive" src="/uploads/{{$payout->id_back}}" style="width: 500px;height: 500px;" alt="Photo">
                        </div>
                      </li>
                      </div>
                      <br>
                    </ul>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection