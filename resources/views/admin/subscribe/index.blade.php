@extends('admin.layouts.master')
@section('page-title')
Subscribers
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Subscribers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Subscribers </li>
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
              <div class="table-responsive">
                <table id="example1" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'; ?>
                    @foreach($subscribers as $row)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$row->email}}</td>
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