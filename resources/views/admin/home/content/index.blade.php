@extends('admin.layouts.master')
@section('page-title')
  Seo Content
@endsection
@section('mainContent')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Content</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Content</li>
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
                <h3 class="card-title">Edit Content</h3>
             <div class="alert" id="table-msg" style="display: none;"></div>

              </div>
              <div class="card-body">
                  <form method="post" id="update_form" enctype="multipart/form-data">

                        <input type="hidden" name="id" >

                <div class="row">

                  
                    <div class="col-md-6">


                    <div class="form-group">
                         <textarea name="title" id="title"
                             rows="30" cols="5"     class="head"  ></textarea>
                    </div>

                        <div class="form-group">
                         <input type="text" name="meta_title" id="meta_title" class="form-control"  maxlength="60"  Placeholder="Meta Title"/> 
                         </div>  

                       </div>
                       
                       
                        <div class="col-md-6">

                       <div class="form-group">
                         <textarea name="description" id="description"
                             rows="30" cols="5"     class="summernote"  ></textarea>
                       </div>

                         <div class="form-group">
                         <textarea id="meta_description" name="meta_description" class="form-control" type="text" Placeholder="Meta Description" maxlength="160">
                          Meta Description
                         </textarea>
                       </div>

                      </div>
                      
                  </div>
                <!-- /.row -->
                     <div class="form-group">
                   <button name="submit" type="submit" value="Submit" id="submit" class="btn btn-primary">Update</button>
                    </div>

                      </form>
                         <!-- /.form -->
                      <!-- /.col-md-12 -->
          
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!--     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 -->
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script language='JavaScript' type='text/javascript'>

 var record = null;
    $(document).ready(function() {
    
         $.ajax(
          {
            url: '/admin/gethomecontent/',
            type: 'GET',
            format: 'json',
                error: function(error) {
                    console.log(error);
                    var message = error.responseJSON.error.messages;
                          },
                success: function(response) {
                    console.log(response);
                   record = response.response.data;

                   var description = response.response.data.description;
                     var title = response.response.data.title;
                      var meta_title = response.response.data.meta_title;
                     var meta_description = response.response.data.meta_description;

                    $('input[name="id"]').val(response.response.data.id) ;
                    $('input[name="meta_title"]').val(meta_title);
                    $('input[name="meta_description"]').text(meta_description);

                      $('.head').summernote('code', title);

                 $('.summernote').summernote('code', description);
                 $('.note-editable').height(300);
                  $('div.note-group-select-from-files').remove();
                  $('.note-insert').style('display: none');

             },

                timeout: 10000 // sets timeout to 3 seconds
          });

    });


  //update
        $("form#update_form").submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax(
            {
              url: '/admin/updatecontent/',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                   error: function(error) {
                            console.log(error);
                    var message = error.responseJSON.error.messages;

                        // alert(message);
 $('#table-msg').html(message).addClass('alert-danger').removeClass('alert-success').show();
                },
                success: function(response) {
                    console.log(response);

                    var code = response.response.code;
                    // console.log(record.length);

                    if (code==200) {
$('#table-msg').html('Record Update Successfully').addClass('alert-success').
                 removeClass('alert-danger').show().delay(2000).fadeOut();
                 
                    } else {

                        var message = response.response.messages;
                        alert(message);
 
                    }
                },

                timeout: 10000 // sets timeout to 3 seconds
            
            });

         });
        //update  Ends ...
  </script>
@endsection