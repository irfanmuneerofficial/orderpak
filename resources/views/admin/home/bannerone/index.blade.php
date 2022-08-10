@extends('admin.layouts.master')
@section('page-title')
Home Banner one
@endsection
@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Banner one</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Banner one</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  @if(!$bannerone)
                <a class="btn btn-success" data-toggle="modal" href='#modal-id'>Create Banner</a>
                @endif
                <div class="modal fade" id="modal-id">
                	<div class="modal-dialog">
                		<div class="modal-content">
                			<form onSubmit="return validateThisFrom (this);" method="post" action="{{url()->current()}}" enctype="multipart/form-data" id="quickForm">
                				<div class="modal-body">
                					@csrf
                					<div class="card card-success">
						              <div class="card-header">
						                <h3 class="card-title">Banner Info</h3>
						              </div>
						              <div class="card-body">
						              	<div class="form-group">
							                <select class="form-control select2" id="category_id" onchange="parentcategory(this.value)" required="" name="category_id" style="width: 100%;">
						                    <option value="">Select Category</option>
						                    @foreach($categories as $data)
						                    <option value="{{$data->id}}">{{$data->title}}</option>
						                    @endforeach
						                  </select>
						                </div>

						              	<div class="form-group">
						                    <label for="exampleInputFile">File input</label>
						                    <div class="input-group">
						                      <div class="custom-file">
						                        <input type="file" name="banner_img" class="custom-file-input" required="" id="exampleInputFile">
						                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
						                      </div>
						                      <div class="input-group-append">
						                        <span class="input-group-text" id="">Upload</span>
						                      </div>
						                    </div>
						                  </div>
						              </div>
						          	</div>
                				</div>
	                			<div class="modal-footer">
	                				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                				<button type="submit" class="btn btn-primary">Save changes</button>
	                			</div>
                			</form>
                		</div>
                	</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Category</th>
                    <th>Banner Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @if($category)
                  	<tr>
                  		<td>{{$category->title}}</td>
                  		<td><img src="/uploads/home/banner/{{$bannerone->banner_img}}" width="100" alt=""></td>
                  		<td>
                  		<a class="btn btn-sm py-0" style="font-size: 0.8em;" data-toggle="modal" href='#modal-{{$bannerone->id}}'><i class="fa fa-edit"></i></a>
                      <div class="modal fade" id="modal-{{$bannerone->id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit row</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form onSubmit="return validateThisFrom (this);" method="post" action="{{url()->current()}}/{{$bannerone->id}}/" enctype="multipart/form-data" id="quickForm">
                					@csrf
	                                {{ method_field('put') }}
                				<div class="modal-body">
                					<div class="card card-success">
						              <div class="card-header">
						                <h3 class="card-title">Banner Info</h3>
						              </div>
						              <div class="card-body">
						              	<div class="form-group">
							                <select class="form-control select2" required="" name="category_id" style="width: 100%;">
						                    <option value="{{$bannerone->category_id}}">{{$bannerone->category->title}}</option>
						                    @foreach($categories as $data)
						                    @if($data->id != $bannerone->category->id)
						                    <option value="{{$data->id}}">{{$data->title}}</option>
						                    @endif
						                    @endforeach
						                  </select>
						                </div>

						              	<div class="form-group">
						                    <label for="exampleInputFile">File input</label>
						                    <div class="input-group">
						                      <div class="custom-file">
						                        <input type="file" name="banner_img" class="custom-file-input" id="exampleInputFile">
						                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
						                      </div>
						                      <div class="input-group-append">
						                        <span class="input-group-text" id="">Upload</span>
						                      </div>
						                    </div>
						                  </div>
						              </div>
						          	</div>
                				</div>
	                			<div class="modal-footer">
	                				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                				<button type="submit" class="btn btn-primary">Save changes</button>
	                			</div>
                			</form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="btn btn-sm py-0" style="font-size: 0.8em;" id="deleteCompany" data-id="{{$bannerone->id}}" ><i class="far fa-trash-alt"></i></a>
                  </td>
                  	</tr>
                  	@else
                  	<div class="alert alert-danger">No Banner Found!</div>
                  	@endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Category</th>
                    <th>Banner Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  @push('ajax_crud')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
function parentcategory(quantidade){
  $.ajax({
    method: "GET",
    url: '/admin/getparentcategory/',
    data: {
        id: quantidade,
    },
    success: function (response) 
    {
      if(response=='')
      {
        $("#parentselect").hide();
        $('#select2').remove();
        $("#childselect").hide();
        $('#select3').remove();
      }
      else
      {
        $("#parentselect").show();
        var myselect = $('<select>');
        $.each(response, function(index, key) {
          myselect.append( $('<option></option>').val(key['id']).html(key['title']) );
        });
        $('#select2').append(myselect.html());
      }
    },                               
  }); 
}
function childcategory(quantidade){
  $.ajax({
    method: "GET",
    url: '/admin/getchildcategory/',
    data: {
        id: quantidade,
    },
    success: function (response) 
    {
      if(response=='')
      {
        $("#childselect").hide();
        $('#select3').remove();
      }
      else
      {
        $("#childselect").show();
        var myselect = $('<select>');
        $.each(response, function(index, key) {
          myselect.append( $('<option></option>').val(key['id']).html(key['title']) );
        });
        $('#select3').append(myselect.html());
      }
    },                               
  }); 
}
</script>
  <script language='JavaScript' type='text/javascript'>
    function validateThisFrom(thisForm) {
        if (thisForm.category_id.value == "") {
            alert("Please make a selection");
            thisForm.category_id.focus();
            return false;
        }
    }
$(document).ready(function () {
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
            url: '/admin/home_banner_one/'+id+'/',
            type: 'DELETE',
            data: {
                  id: id,
                  "_token": token,
            },
            success: function (response){         	
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