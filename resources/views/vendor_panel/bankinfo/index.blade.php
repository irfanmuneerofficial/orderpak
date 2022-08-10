@extends('vendor_panel.layouts.master')
@section('title')
Account Info
@endsection
@section('mainContent')
<div class="content-header">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
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
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Bank Info</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Bank Info</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </div>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany"  href='/vendor/payout/create'>Create Info</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Account Title</th>
                    <th>Account No</th>
                    <th>Bank Name</th>
                    <th>Branch Code</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id ='1'?>
                    @foreach($data as $row)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$row->account_title}}</td>
                      <td>{{$row->account_no}}</td>
                      <td>{{$row->bank_name}}</td>
                      <td>{{$row->branch_code}}</td>
                      <td>
                        <a class="btn btn-sm" href="/vendor/payout/{{$row->id}}/edit" ><i class="far fa-edit"></i></a>

                        <a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{$row->id}}" ><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Account Title</th>
                    <th>Account No</th>
                    <th>Bank Name</th>
                    <th>Branch Code</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //DeleteCompany
 $('body').on('click', '#deleteCompany', function (event) {
    swal({
      title: "Are you sure Want to delete this?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

        event.preventDefault();
        var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");

        $.ajax(
          {
            url: '/vendor/payout/'+id+'/',
            type: 'DELETE',
            data: {
                  id: id,
                  "_token": token,
            },
            success: function (response){
            
              swal("Poof! Your has been deleted!", {
                icon: "success",
              });
              location.reload(true);
            }
          });
        } 
        else {
          swal("Your Data is safe!");
        }
      });
    });
  }); 
</script>
@endsection