@extends('admin.layouts.master')

@section('page-title')
    Profile
@endsection

@section('mainContent')
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Profile </li>
                </ol>
            </div><!-- /.col -->
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5 mt-5">
                    <div class="card card-primary card-dark">
                        <h5 class="card-header">Edit Profile</h5>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body box-profile">
                            @php($url = route('admin.profile.update'). '/')
                            {!! Form::model($profile, ['method' => 'PATCH','url' => $url, 'enctype' => "multipart/form-data"]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        {!! Form::text('first_name', null, array('placeholder' => 'John','class' => 'form-control')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        {!! Form::text('last_name', null, array('placeholder' => 'Doe','class' => 'form-control')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        {!! Form::text('email', null, array('placeholder' => 'johndoe@yahoo.com','class' => 'form-control')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar" class="col-form-label">{{ __('Avatar (optional)') }}</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/admin/profile" class="btn btn-danger">cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
