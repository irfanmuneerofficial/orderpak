@extends('admin.layouts.master')

@section('page-title')
    Roles List
@endsection

@section('mainContent')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <span>{{ $message }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 margin-tb mt-3">
                    <div class="pull-right mb-2">
                    @can('role-create')
                        <a class="btn btn-primary" href="{{ route('admin.roles.create') }}"> Add New</a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <h5 class="card-header">Roles List</h5>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                                </tr>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.roles.show',$role->id) }}">Show</a>
                                        @can('role-edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            @php($url = route('admin.roles.update', [$role->id]).'/')
                                            {!! Form::open(['method' => 'DELETE','url' => [$url],'style'=>'display:inline', "onsubmit"=>"return confirm('Are you sure?')"]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                            {!! $roles->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
