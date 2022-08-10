@extends('admin.layouts.master')
@section('page-title')
Users
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Wishlist Statistics</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Wishlist Statistics </li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <div class="table-responsive">
                <table id="wishlist_list" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Title</th>
                        <th>Wishlist Count</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                    <tr id="">
                        <td>{{$row->id}}</td>
                        <td>{{$row->title}}</td>
                        <td>{{$row->total}}</td>
                        <td>
                            <form id="formDelete" name="formDelete" method="post" action="/admin/wishlist/delete/{{ $row->id }}/">
                                @csrf
                                {{ @method_field('delete') }}
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
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

@push('wishlist-page-script')
<script>

  $("#wishlist_list").DataTable({
    "responsive": true,
    "autoWidth": false,
    "ordering": false,
  });

</script>
@endpush