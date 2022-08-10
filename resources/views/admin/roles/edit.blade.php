@extends('admin.layouts.master')

@section('page-title')
    Edit Role
@endsection

@section('mainContent')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 margin-tb">
                    <div class="pull-right mb-2 mt-2">
                        <a class="btn btn-info btn-block" href="{{ route('admin.roles.index') }}"> Back</a>
                    </div>
                </div>
            </div>

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

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <h5 class="card-header">Edit Role</h5>
                        <div class="card-body">
                            @php($url = route('admin.roles.update', [$role->id]).'/')
                            {!! Form::model($role, ['method' => 'PATCH','url' => [$url]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        {!! Form::text('name', null, array('placeholder' => 'Role Name', 'class' => 'form-control col-md-4', 'readonly')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label class="guardName">Guard Name</label>
                                        {!! Form::select('guard_name', [ 'admin' => 'Admin', 'vendor' => 'Vendor', 'web' => 'Customer' ], $role->guard_name, ['class' => 'form-control col-md-4 permission-drp-select', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        @foreach($permission as $key => $per)
                                        <div style="display:none" class="permission-div" id="per_{{ $key }}">
                                            <h5><strong>Permission for </strong><i>Role {{ ($key == 'web' ? 'Customer' : ucfirst($key)) }}</i></h5>
                                            @foreach($per as $value)
                                                <label class="permission">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    <span class="permission_value">{{ $value->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="/admin/roles" class="btn btn-danger">cancel</a>
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

@push('role-edit-js')
    <script>
        $(document).ready(function(){
            var guard = jQuery('.permission-drp-select :selected').val();

            jQuery('.permission-drp-select').hide();
            jQuery('.guardName').hide();

            jQuery('#per_'+guard).show();

            jQuery('.permission-drp-select').change(function(){
                jQuery('#per_'+guard).hide();
                guard = jQuery('.permission-drp-select :selected').val();
                jQuery('#per_'+guard).show();
            });
        });
    </script>
@endpush
