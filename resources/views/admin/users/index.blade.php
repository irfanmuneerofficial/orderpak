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
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Users </li>
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
                <table id="userlist" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Phone No</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{--<?php $id ='1'; ?>--}}
                    @foreach($users as $row)
                    @if(!$row->is_admin == '1')
                    <tr id="delete_user_{{ $row->id }}">
                      <td>{{$row->id}}</td>
                      <td>{{$row->fullname}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{$row->phone}}</td>
                      <td>
                     
                        <a class="btn btn-info" href="/admin/users/edit/{{ $row->id }}">
                          Edit
                        </a><br/>
                        <form id="formDelete" name="formDelete" method="post" action="/admin/users/delete/{{ $row->id }}/">
                          @csrf
                          {{ @method_field('delete') }}
                          <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                        </form>
                        
                        
                      </td>
                    </tr>
                    @endif
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

@push('userlist-page-script')
<script>

  $("#userlist").DataTable({
    "responsive": true,
    "autoWidth": false,
    "ordering": false,
  });

  /*$('.delete_users').click(function(e){
    e.preventDefault();
    var user_id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url =   "{{ url('/admin/users/delete/') }}";
  
    if(confirm("Are you sure you want to delete this?")){
      $.ajax({
        url: url+'/'+user_id,
        type: 'DELETE',
        data: {
            "id": user_id,
            "_token": token,
        },
        success: function (response){
         
            if(response.status  == 'ok'){
              $('tr#delete_user_'+user_id).remove();
            }
            else{
              alert('Somthing goes worng!')
            }
        },
        error: function (error) {
            alert('error; ' + eval(error));
        }
      });
    }
    else{
        return false;
    }
  });*/

</script>
@endpush