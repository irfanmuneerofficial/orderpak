@extends('admin.layouts.master')

@section('page-title')
    Change Password
@endsection

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Change Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Change Password </li>
                </ol>
            </div><!-- /.col -->
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 mt-5">
                    <!-- Profile Image -->
                    <div class="card card-primary card-dark">
                        <h5 class="card-header">Change Password</h5>

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
                            <div class="col-lg-12">
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <span>{{ $message }}</span>
                                </div>
                                @endif
                            </div>

                        <div class="card-body box-profile">
                            @php($url = route('admin.profile.updatepassword'). '/')
                            {!! Form::model($profile, ['method' => 'PATCH','url' => $url]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>New Password:</label>
                                        {!! Form::password('new_password', array('id' => 'password', 'class' => 'form-control')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password:</label>
                                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/admin/profile" class="btn btn-danger">cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
