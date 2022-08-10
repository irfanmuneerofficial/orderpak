@extends('admin.layouts.master')
@section('page-title')
Sliders
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sliders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders </li>
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
                <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Create Slider </a>
                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form role="form" method="post" action="/admin/sliders/" autocomplete="off" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Color</label>
                                <input type="text" name="name" class="form-control my-colorpicker1">
                              <!--<input type="text" id="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">-->
                            </div>
                            <!--<div class="form-group">-->
                            <!--  <label for="exampleInputEmail1">Title</label>-->
                            <!--  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">-->
                            <!--</div>-->
                            <div class="form-group">
                              <label for="exampleInputFile">File input</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="form-control" id="slider_img" name="slider_img">
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text" id="">Upload</span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Link</label>
                              <input type="text" class="form-control" id="link" name="link" placeholder="Enter Link">
                            </div>
                            <!--<div class="form-group">-->
                            <!--  <label for="exampleInputEmail1">Description</label>-->
                            <!--  <textarea name="description" id="description" class="form-control" rows="3" required="required"></textarea>-->
                            <!--</div>-->
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
                      <th>Color</th>
                      <!--<th>Name</th>-->
                      <!--<th>Description</th>-->
                      <th>Slider_img</th>
                      <th>Link</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'; ?>
                    @foreach($sliders as $row)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$row->name}}</td>
                      <!--<td>{{$row->name}}</td>-->
                      <!--<td>{{$row->description}}</td>-->
                      <td><img src="/uploads/slider/{{$row->slider_img}}" width="50" alt=""></td>
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
                                <form role="form" id="updateform" action="/admin/sliders/{{$row->id}}/" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="card-body">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Color</label>
                                            <input type="text" name="name" value="{{$row->name}}" class="form-control my-colorpicker1">
                                            <!--<input type="text" class="form-control" id="edittitle" value="{{$row->title}}" name="title" placeholder="Enter Title">-->
                                          </div>
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Link</label>
                                            <input type="text" class="form-control" id="editlink" value="{{$row->link}}" name="link" placeholder="Enter Link">
                                          </div>
                                          <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="form-control" value="{{$row->editslider_img}}" id="editslider_img" name="slider_img">
                                              </div>
                                              <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                              </div>
                                            </div>
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
                        <form method="post" action="/admin/sliders/{{ $row->id }}/">
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(function () {
    $('.my-colorpicker1').colorpicker();
});

</script>
  @endsection