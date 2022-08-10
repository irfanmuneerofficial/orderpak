@extends('vendor_panel.layouts.master')
@section('title')
Add Product
@endsection
@section('mainContent')
<section class="content">
  <div class="row">
    <div class="col-12">
      
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          {{-- <h3 class="card-title">DataTable with default features</h3> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Product Title</th>
                <th>Product SKU</th>
                <th>Price</th>
                <th>Condition</th>
                <!--<th>Status</th>-->
                <th>Approval</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
                <td>{{ $product->title }}</td>
                {{-- <td>{{ $product->brand->title }}</td> --}}
                <td>{{ $product->product_sku }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->condition }}</td>
                <!--<td class="project-state">-->
                <!--  @if($product->vendor_status == 'ACTIVE')-->
                <!--  <a href="/vendor/status/{{$product->id}}"><span class="badge badge-success">{{ $product->vendor_status }}</span></a>-->
                <!--  @else-->
                <!--  <a href="/vendor/status/{{$product->id}}"><span class="badge badge-danger">{{ $product->vendor_status }}</span></a>-->
                <!--  @endif-->
                <!--</td>-->
                <td class="project-state">
                  @if($product->admin_status == 'APPROVED')
                  <span class="badge badge-success">{{ $product->admin_status }}</span>
                  @else
                  <span class="badge badge-warning">{{ $product->admin_status }}</span>
                  @endif
                </td>
                <td class="project-actions text-right">
                  <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-eye"></i>View</a>                          
                  <a class="btn btn-success btn-sm" href="/vendor/product/{{ $product->id }}/edit">
                    <i class="fas fa-pen"></i>Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="#">
                    <i class="fas fa-trash"></i>Delete
                  </a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Product Title</th>
            <th>Product SKU</th>
            <th>Price</th>
            <th>Condition</th>
            <!--<th>Status</th>-->
            <th>Approval</th>
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
</section>

@endsection