@extends('vendor_panel.layouts.master')
@section('title')
  Commission
@endsection
@section('mainContent')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Commission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Commission </li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header">
                <a class="btn btn-success py-0" style="font-size: 0.8em; width:100px;" id="createNewCompany" href='{{route('commission.create')}}'>Create Commission</a>
              </div> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Main Category</th>
                    <th>Main Category Rate</th>
                    <th>Parent Category</th>
                    <th>Parent Category Rate</th>
                    <th>Child Category</th>
                    <th>Child Category Rate</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
                    @foreach($commissions as $row)
                    <tr>
                      @if($row->category_id == null)
                      <td>Non</td>
                      @else
                      <td>{{$row->category->title}}</td>
                      @endif
                      @if($row->main_rate == null)
                      <td>0%</td>
                      @else
                      <td>{{$row->main_rate}}%</td>
                      @endif
                      @if($row->parent_id == null)
                      <td>Non</td>
                      @else
                      <td>{{$row->parentcategory->title}}</td>
                      @endif
                      @if($row->parent_rate == null)
                      <td>0%</td>
                      @else
                      <td>{{$row->parent_rate}}%</td>
                      @endif
                      @if($row->child_id == null)
                      <td>Non</td>
                      @else
                      <td>{{$row->childcategory->title}}</td>
                      @endif
                      @if($row->child_rate == null)
                      <td>0%</td>
                      @else
                      <td>{{$row->child_rate}}%</td>
                      @endif
                      
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Main Category Rate</th>
                    <th>Main Category</th>
                    <th>Parent Category Rate</th>
                    <th>Parent Category</th>
                    <th>Child Category Rate</th>
                    <th>Child Category</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

@endsection