@extends('admin.layouts.master')
@section('page-title')
Category Banner
@endsection
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category Banner</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Banner </li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Create Banner </a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form role="form" method="post" action="/admin/category_banner/" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Link</label>
                              <input type="text" class="form-control" id="link" name="link" placeholder="Enter Link">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputFile">File input</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="form-control"  name="banner_img">
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="">Upload</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
              <div class="table-responsive">
                <table id="example1" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th> Nanner Image</th>
                      <th>Link</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'; ?>
                    @foreach($categories as $row)
                    <tr>
                      <td>{{$id++}}</td>
                      <td><img src="/uploads/category/{{$row->banner_img}}" width="50" alt=""></td>
                      <td>{{$row->link}}</td>
                      <td>
                        <a href="{{$row->id}}" data-hover="tooltip" data-placement="top" data-target="#modal-edit-customers{{ $row->id }}" data-toggle="modal" id="modal-edit" title="Edit"></a>
                        <a class="btn btn-sm" data-toggle="modal" href='#modal-{{$row->id}}'><i class="fa fa-edit"></i></a>
                        <div class="modal fade" id="modal-{{$row->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit banner</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <form role="form" id="updateform" action="/admin/category_banner/?id={{$row->id}}/" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="card-body">
                                          <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="form-control" name="banner_img">
                                              </div>
                                              <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Link</label>
                                            <input type="text" class="form-control" name="link" value="{{$row->link}}">
                                          </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                      </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <form method="post" action="/admin/category_banner/?id={{$row->id}}/">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-sm py-0"> <i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div></div></div>
    </section>
    <!-- /.content -->
  </div>

  @endsection