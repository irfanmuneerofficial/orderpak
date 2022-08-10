@extends('admin.layouts.master')

@section('page-title')
    Show Role
@endsection

@section('mainContent')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 margin-tb">
                    <div class="pull-right mb-2 mt-3">
                        <a class="btn btn-info btn-block" href="{{ route('admin.roles.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <h5 class="card-header">Show Role</h5>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <div class="form-group role-box">
                                        <label>Role | </label>
                                        <span>{{ $role->name }}</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="permission-box">Permissions</label>

                                        @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                                <label class="label label-success permission">{{ $v->name }}</label>
                                            @endforeach
                                        @endif
                                    </div>
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
