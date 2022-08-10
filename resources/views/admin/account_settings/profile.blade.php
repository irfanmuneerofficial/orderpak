@extends('admin.layouts.master')

@section('page-title')
    Profile
@endsection

@section('mainContent')

<style>
    .top1 {
        height:150px;
        background-color:#FFFFFF;
        margin-top:10px;
        overflow: hidden;
        width: 150px;
    }

    .top1 img {
        height:100%;
        width: 100%;
    }
</style>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile </li>
                </ol>
            </div><!-- /.col -->
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 mt-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-dark">
                        <h5 class="card-header">Profile</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <span>{{ $message }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle top1"
                                    src="{{ isset($profile->profile_image) ? asset('admin/images/profile/'.$profile->profile_image) : asset('admin/images/profile/noimage.png')}}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $profile->name }}</h3>

                            <p class="text-muted text-center">{{ $profile->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                {{-- <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $profile->email }}</a>
                                </li> --}}
                                <li class="list-group-item">
                                <b>Created At</b> <a class="float-right">{{ $profile->created_at->format('d/m/Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                <b>Status</b> <a class="float-right">{{ ($profile->status == 1 ? 'Active' : 'De-active') }}</a>
                                </li>
                            </ul>
                            <br />
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                            <a href="{{ route('admin.profile.changepassword') }}" class="btn btn-info btn-block"><b>Change Password</b></a>
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




